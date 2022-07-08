<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\CrudException;
use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExpenseRequest;
use App\Http\Requests\Admin\ExpenseLineRequest;
use App\Http\Resources\Admin\Expense\ExpenseLineResource;
use App\Http\Resources\Admin\Expense\ExpenseResource;
use App\Http\Traits\QueryTrait;
use App\Models\Expense;
use App\Models\ExpenseLine;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExpenseController extends Controller
{
    use QueryTrait;

    public function get(Request $request)
    {
        try {
            $data = Expense::with('user', 'user.company', 'user.department', 'lines.type')
                ->where(function ($query) use ($request) {
                    $query->when($request->company_id, function ($query) use ($request) {
                        $query->whereRelation('user', 'company_id', $request->company_id);
                    });
                    $query->when($request->department_id, function ($query) use ($request) {
                        $query->whereRelation('user', 'department_id', $request->department_id);
                    });
                    $query->when($request->type_id, function ($query) use ($request) {
                        $query->whereRelation('lines', 'type_id', $request->type_id);
                    });
                    $query->when($request->start_date && $request->end_date, function ($query) use ($request) {
                        $this->filterOneColumnDateRelation($query, $request, 'lines', 'date');
                    });
                    $query->when($request->status, function ($query) use ($request) {
                        $query->where('status', $request->status);
                    });
                })
                ->paginate($request->page_count ?? 15);
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return ExpenseResource::collection($data);
    }

    public function store(ExpenseRequest $request)
    {
        DB::beginTransaction();
        try {
            $expense = Expense::create([
                'user_id' => $request->user_id,
                'status' => $request->status,
                'notes' => $request->notes,
            ]);

            if ($expense) {
                $expense_lines = collect($request->lines);
                $expense_lines = $expense_lines->map(function ($line) use ($expense) {
                    return $this->storeExpenseLine($line, $expense);
                });
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.expense')]));
        }

        DB::commit();

        return $this->storeSuccessfully(trans('messages.expense'), []);
    }

    private function storeFile($file)
    {
        return Storage::putFile('expenses', $file);
    }

    private function storeExpenseLine($line, Expense $expense, $isTransaction = true)
    {
        $file = null;

        try {
            $this->checkExpenseStatus($expense->status);

            if (array_key_exists('file', $line)) {
                $file = $this->storeFile($line['file']);
            }
            $data = ExpenseLine::create([
                'expense_id' => $expense->id,
                'type_id' => $line['type_id'],
                'date' => format_date($line['date'], 'Y-m-d'),
                'file' => $file,
                'desc' => $line['desc'] ?? null,
                'price' => floatval($line['price'])
            ]);
        } catch (\Throwable $th) {
            $isTransaction ? DB::rollBack() : '';
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.expense_line')]));
        }
        return $data;
    }

    private function checkExpenseStatus($status)
    {
        if ($status == 'accepted' && Auth::user()->role_id == '4') {
            throw new Exception(trans('messages.expenseUpdateExceptionMessage'));
        }
    }

    public function delete(Expense $expense)
    {
        $expense->delete();
        return $this->deleteSuccessfully(trans('messages.expense'));
    }

    public function update(ExpenseRequest $request, Expense $expense)
    {

        $this->checkExpenseStatus($expense->status);

        try {
            $expense->update([
                'status' => $request->status,
                'notes' => $request->notes,
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.expense')]));
        }

        return $this->updateSuccessfully(trans('messages.expense'), new ExpenseResource($expense->load('user.company', 'user.department', 'lines.type')));
    }

    public function deleteExpenseLine(Expense $expense, ExpenseLine $expenseline)
    {
        $this->checkExpenseStatus($expense->status);

        $expenseline->delete();
        return $this->deleteSuccessfully(trans('messages.expense_line'));
    }



    public function updateExpenseLine(ExpenseLineRequest $request,  Expense $expense, $expenseline)
    {
        $line = ExpenseLine::findOrFail($expenseline);
        try {
            $this->checkExpenseStatus($expense->status);

            $file = null;
            if ($request->file) {
                $file = $request->hasFile('file') ? $this->storeFile($request->file) : $line->file;
            }

            if (!$request->file) {
                $line->file ? $this->deleteOldFile($line->file) : '';
            }

            $line->update([
                'date' => format_date($request->date, 'Y-m-d'),
                'desc' => $request->desc,
                'file' => $file,
                'price' => floatval($request->price),
                'type_id' => $request->type_id,
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.expense_line')]));
        }

        return $this->updateSuccessfully(trans('messages.expense_line'), new ExpenseLineResource($line->load('type')));
    }

    public function addExpenseLine(ExpenseLineRequest $request, Expense $expense)
    {
        $this->checkExpenseStatus($expense->status);

        try {
            $data = $this->storeExpenseLine($request->validated(), $expense);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.expense_line')]));
        }

        return $this->storeSuccessfully(trans('messages.expense_line'), new ExpenseLineResource($data->load('type')));
    }
}
