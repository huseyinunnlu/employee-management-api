<?php

namespace App\Http\Controllers;

use App\Exceptions\HttpQueryException;
use App\Http\Resources\Admin\Expense\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyExpenseController extends Controller
{
    public function get(Request $request)
    {
        try {
            $data = Expense::with('user.company.department', 'lines.type')
                ->where('user_id', Auth::user()->id)
                ->where(function ($query) use ($request) {
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
}
