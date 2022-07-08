<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Reports\AbsenceAddRequest;
use App\Http\Resources\Admin\Reports\AbsenceReportResource;
use App\Http\Resources\Admin\Tree\ManagerResource;
use App\Models\Absence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\Absence as AbsenceTrait;
use App\Http\Traits\QueryTrait;

class AbsenceReportController extends Controller
{
    use AbsenceTrait;
    use QueryTrait;

    public function get(Request $request)
    {
        try {
            $data = Absence::with('user', 'type')
                ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                    //This function filtering datas by start date and end date. This function coming from Query trait
                    $this->filterTwoColumnDate($query, $request);
                })
                ->when($request->type_id, function ($query) use ($request) {
                    $query->where('type_id', $request->type_id);
                })
                ->when($request->company_id, function ($query) use ($request) {
                    $query->whereRelation('user', 'company_id', $request->company_id);
                })
                ->when($request->department_id, function ($query) use ($request) {
                    $query->whereRelation('user', 'department_id', $request->department_id);
                })
                ->when($request->status, function ($query) use ($request) {
                    $query->where('status', $request->status);
                })

                ->paginate($request->page_count ?? 15);
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return AbsenceReportResource::collection($data);
    }

    public function getAddUsers()
    {
        try {
            $data = User::with('department', 'company')->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return ManagerResource::collection($data);
    }

    public function addAbsence(AbsenceAddRequest $request)
    {
        //collect selected users for absence adding
        $users = collect($request->users);

        $stored_users_exception = $users->map(function ($user) use ($request) {
            try {
                //get selected users deserved absence days this function coming from AbsenceTrait
                $days = $this->calculateUserDeservedDays($user);
                //This function checking start date and end absence date is valid
                $dates = $this->checkValidDateRange($request->date, [$request->start_time, $request->end_time]);
                //This code calculating day count between two dates
                $calculated_days = Carbon::parse($dates['start_date'])->diffInDays(Carbon::parse($dates['end_date'])) + 1;
                $remainig = $days[0] - $days[1]['sum_days'];

                if ($calculated_days > $remainig) {
                    $selected_user = User::whereId($user)->select('first_name', 'last_name')->first();
                    return trans('messages.user_absence_exception', ['name' => $selected_user->first_name . ' ' . $selected_user->last_name, 'day' => $calculated_days - $remainig]);
                }
                Absence::create([
                    "day_type" => $request->day_type,
                    "end_time" => $request->end_time,
                    "start_date" => $dates['start_date'],
                    "end_date" => $dates['end_date'],
                    "start_time" => $request->start_time,
                    "status" => $request->status,
                    "type_id" => $request->type_id,
                    "user_id" => $user,
                ]);
            } catch (\Throwable $th) {
                $selected_user = User::whereId($user)->select('first_name', 'last_name')->first();
                return trans('messages.user_absence_exception_message', ['name' => $selected_user->first_name . ' ' . $selected_user->last_name]);
            }
        });

        $data = count($stored_users_exception) > 0 && $stored_users_exception[0] ? $stored_users_exception : [];

        return $this->storeSuccessfully(trans('messages.absence'), $data);
    }
}
