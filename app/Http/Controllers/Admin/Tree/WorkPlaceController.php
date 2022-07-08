<?php

namespace App\Http\Controllers\Admin\Tree;

use App\Exceptions\CrudException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tree\WorkingHourRequest;
use App\Http\Requests\Admin\Tree\WorkPlaceRequest;
use App\Http\Resources\Admin\Tree\WorkPlaceResource;
use App\Models\WorkPlace;

class WorkPlaceController extends Controller
{
    public function get(Workplace $workplace)
    {
        return new WorkPlaceResource($workplace->load('department', 'city.country'));
    }

    public function add(WorkPlaceRequest $request)
    {
        try {
            $data = WorkPlace::with('department.company.musteri', 'city.country')->create([
                'title' => $request->title,
                'city_id' => $request->city_id,
                'department_id' => $request->department_id,
                'email' => $request->email,
                'morning_start_time' => $request->morning['start_time'],
                'morning_end_time' => $request->morning['end_time'],
                'morning_break' => $request->morning['break_time'],
                'afternoon_start_time' => $request->afternoon['start_time'],
                'afternoon_end_time' => $request->afternoon['end_time'],
                'afternoon_break' => $request->afternoon['break_time'],
                'night_start_time' => $request->night['start_time'],
                'night_end_time' => $request->night['end_time'],
                'night_break' => $request->night['break_time'],
                'full_start_time' => $request->full['start_time'],
                'full_end_time' => $request->full['end_time'],
                'full_break' => $request->full['break_time'],
                'report_start_time' => $request->report['start_time'],
                'report_end_time' => $request->report['end_time'],
                'report_break' => $request->report['break_time'],
                'permit_start_time' => $request->permit['start_time'],
                'permit_end_time' => $request->permit['end_time'],
                'permit_break' => $request->permit['break_time'],
                'annual_permit_start_time' => $request->annual['start_time'],
                'annual_permit_end_time' => $request->annual['end_time'],
                'annual_permit_break' => $request->annual['break_time'],
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.work_place')]));
        }
        return $this->storeSuccessfully(trans('messages.work_place'), new WorkPlaceResource($data->load('department', 'city.country')));
    }

    public function updateWorkingHour(WorkingHourRequest $request, WorkPlace $workplace)
    {
        try {
            $workplace->update([
                'morning_start_time' => $request->morning['start_time'],
                'morning_end_time' => $request->morning['end_time'],
                'morning_break' => $request->morning['break_time'],
                'afternoon_start_time' => $request->afternoon['start_time'],
                'afternoon_end_time' => $request->afternoon['end_time'],
                'afternoon_break' => $request->afternoon['break_time'],
                'night_start_time' => $request->night['start_time'],
                'night_end_time' => $request->night['end_time'],
                'night_break' => $request->night['break_time'],
                'full_start_time' => $request->full['start_time'],
                'full_end_time' => $request->full['end_time'],
                'full_break' => $request->full['break_time'],
                'report_start_time' => $request->report['start_time'],
                'report_end_time' => $request->report['end_time'],
                'report_break' => $request->report['break_time'],
                'permit_start_time' => $request->permit['start_time'],
                'permit_end_time' => $request->permit['end_time'],
                'permit_break' => $request->permit['break_time'],
                'annual_permit_start_time' => $request->annual['start_time'],
                'annual_permit_end_time' => $request->annual['end_time'],
                'annual_permit_break' => $request->annual['break_time'],
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.work_place')]));
        }
        return $this->updateSuccessfully(trans('messages.work_place'), new WorkPlaceResource($workplace->load('department', 'city.country')));
    }

    public function update(WorkPlaceRequest $request, WorkPlace $workplace)
    {
        try {
            $workplace->update($request->validated());
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.work_place')]));
        }
        return $this->updateSuccessfully(trans('messages.work_place'), new WorkPlaceResource($workplace->load('department', 'city.country')));
    }
}
