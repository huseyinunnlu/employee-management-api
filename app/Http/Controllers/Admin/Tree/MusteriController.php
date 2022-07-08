<?php

namespace App\Http\Controllers\Admin\Tree;

use App\Exceptions\CrudException;
use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tree\EmployeerBranchRequest;
use App\Http\Requests\Admin\Tree\MusteriRequest;
use App\Http\Resources\Admin\Tree\CompanyResource;
use App\Http\Resources\Admin\Tree\EmployeerBranchResource;
use App\Http\Resources\Admin\Tree\MusteriResource;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Company;
use App\Models\EmployeerBranch;
use App\Models\Musteri;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MusteriController extends Controller
{
    public function get(Musteri $musteri)
    {
        return new MusteriResource($musteri);
    }

    public function update(MusteriRequest $request, Musteri $musteri)
    {
        try {
            $musteri->update($request->validated());
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.musteri')]));
        }

        return $this->updateSuccessfully(trans('messages.musteri'), new MusteriResource($musteri));
    }

    public function getEmployeerBranches($id)
    {
        try {
            $data = EmployeerBranch::where('musteri_id', $id)->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return EmployeerBranchResource::collection($data);
    }

    public function addEmployeerBranch(EmployeerBranchRequest $request, $id)
    {
        try {
            $data = EmployeerBranch::create([
                "musteri_id" => $id,
                "employeer_title" => $request->employeer_title,
                "tax" => $request->tax,
                "tax_no" => $request->tax_no,
                "website" => $request->website,
                "workplace_registration_number" => $request->workplace_registration_number,
                "commercial_registration_number" => $request->commercial_registration_number,
                "address" => $request->address,
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_created', ['attr' => trans('messages.employeer_branch')]));
        }

        return $this->updateSuccessfully(trans('messages.employeer_branch'), new EmployeerBranchResource($data));
    }

    public function deleteEmployeerBranch($musteri_id, EmployeerBranch $employeerbranch)
    {
        $employeerbranch->delete();
        return $this->deleteSuccessfully(trans('messages.employeer_branch'));
    }

    public function updateEmployeerBranch(EmployeerBranchRequest $request, $musteri_id, EmployeerBranch $employeerbranch)
    {
        try {
            $employeerbranch->update($request->validated());
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.employeer_branch')]));
        }

        return $this->updateSuccessfully(trans('messages.employeer_branch'), new EmployeerBranchResource($employeerbranch));
    }

    public function getCompanies($id)
    {
        try {
            $data = Company::where('musteri_id', $id)->with('city')->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return CompanyResource::collection($data);
    }

    public function deleteCompany($musteri_id, Company $company)
    {
        $company->delete();
        return $this->deleteSuccessfully(trans('messages.company'));
    }

    public function getEmployeesByTree(Request $request, $id)
    {
        try {
            $data = User::with('department', 'company')->where($request->column, $id)->get();
        } catch (\Throwable $e) {
            throw new HttpQueryException();
        }

        return EmployeeResource::collection($data);
    }
}
