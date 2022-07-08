<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\CrudException;
use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\EmployeeStoreRequest;
use App\Http\Resources\Employee\EmployeeEditResource;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\QueryTrait;


class EmployeeController extends Controller
{
    use QueryTrait;

    public function get(Request $request)
    {
        try {
            $data = User::with('department', 'company')
                ->when($request->role, function ($query) use ($request) {
                    $query->where('role_id', $request->role);
                })
                ->when($request->search, function ($query) use ($request) {
                    $this->filterByFullName($query, $request->search);
                })
                ->when($request->company_id, function ($query) use ($request) {
                    $query->where('company_id', $request->company_id);
                })
                ->when($request->department_id, function ($query) use ($request) {
                    $query->where('department_id', $request->department_id);
                })
                ->when($request->position_id, function ($query) use ($request) {
                    $query->where('position_id', $request->position_id);
                })
                ->orderBy($request->sortColumn ?? 'created_at', $request->sortType ?? 'desc')
                ->paginate($request->page_count);
        } catch (\Throwable $e) {
            throw new HttpQueryException();
        }

        return EmployeeResource::collection($data);
    }

    public function store(EmployeeStoreRequest $request)
    {
        try {
            $storeData = [
                "role_id" => $request->role_id,
                "musteri_id" => $request->musteri_id,
                "language_id" => $request->language_id,
                "company_id" => $request->company_id,
                "department_id" => $request->department_id,
                "employeer_branch_id" => $request->employeer_branch_id,
                "position_id" => $request->position_id,
                "manager_id" => $request->manager_id,
                "work_place_id" => $request->work_place_id,
                "job_id" => $request->job_id,
                "insurance_no" => $request->insurance_no,
                "start_date" => Carbon::parse($request->start_date)->format('Y-m-d'),
                "birthday" => Carbon::parse($request->birthday)->format('Y-m-d'),
                "work_type" => $request->work_type,
                "work_status" => $request->work_status,
                "insurance_status" => $request->insurance_status,
                "language_id" => $request->language_id,
                "arrangment_end_date" => Carbon::parse($request->arrangment_end_date)->format('Y-m-d'),
                "disability_status" => $request->disability_status,
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "id_number" => $request->id_number,
                "id_serie_number" => $request->id_serie_number,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "registration_number" => $request->registration_number,
                "can_sign_in" => $request->can_sign_in,
                "can_edit_profile" => $request->can_edit_profile,
                "can_edit_email" => $request->can_edit_email,
                "can_see_salary" => $request->can_see_salary,
            ];

            $data = User::with('role')->create($storeData);
            $data->update();
        } catch (\Throwable $e) {
            return $e;
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.employee')]));
        }

        return $this->storeSuccessfully(trans('messages.employee'), []);
    }

    public function update(EmployeeStoreRequest $request, User $user)
    {
        try {
            $store_data = [
                "role_id" => $request->role_id,
                "musteri_id" => $request->musteri_id,
                "language_id" => $request->language_id,
                "company_id" => $request->company_id,
                "department_id" => $request->department_id,
                "employeer_branch_id" => $request->employeer_branch_id,
                "position_id" => $request->position_id,
                "manager_id" => $request->manager_id,
                "work_place_id" => $request->work_place_id,
                "job_id" => $request->job_id,
                "insurance_no" => $request->insurance_no,
                "start_date" => Carbon::parse($request->start_date)->format('Y-m-d'),
                "birthday" => Carbon::parse($request->birthday)->format('Y-m-d'),
                "work_type" => $request->work_type,
                "work_status" => $request->work_status,
                "insurance_status" => $request->insurance_status,
                "language_id" => $request->language_id,
                "arrangment_end_date" => Carbon::parse($request->arrangment_end_date)->format('Y-m-d'),
                "disability_status" => $request->disability_status,
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "id_number" => $request->id_number,
                "id_serie_number" => $request->id_serie_number,
                "email" => $request->email,
                "registration_number" => $request->registration_number,
                "can_sign_in" => $request->can_sign_in,
                "can_edit_profile" => $request->can_edit_profile,
                "can_edit_email" => $request->can_edit_email,
                "can_see_salary" => $request->can_see_salary,
            ];

            $user->update($store_data);
        } catch (\Throwable $e) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.employee')]));
        }

        return $this->updateSuccessfully(trans('messages.employee'), []);
    }

    public function getSelectedEmployee(User $user)
    {
        return new EmployeeEditResource($user);
    }

    public function changeStatus(Request $request, User $user)
    {
        try {
            $user->update([
                'status' => $request->status,
            ]);
        } catch (\Throwable $e) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.employee')]));
        }

        return $this->changeStatusSuccessfully(trans('messages.employee'));
    }
}
