<?php

namespace App\Http\Controllers\Admin\Tree;

use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tree\PermRequest;
use App\Http\Resources\Admin\Tree\CompanyTreeResource;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Traits\Manager;
use App\Models\Company;
use App\Models\Department;
use App\Models\Musteri;
use App\Models\User;
use App\Models\UserPerm;
use App\Models\WorkPlace;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TreeController extends Controller
{
    use Manager;

    public function getCompanyTree()
    {
        try {
            $data = Musteri::with('companies.departments.positions.titles', 'companies.departments.work_places')->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return CompanyTreeResource::collection($data);
    }

    public function deleteTree(Request $request, $id)
    {
        if ($request->data == 'Musteri') {
            $data = Musteri::whereId($id)->first();
        } else if ($request->data == 'Company') {
            $data = Company::whereId($id)->first();
        } else if ($request->data == 'Department') {
            $data = Department::whereId($id)->first();
        } else if ($request->data == 'WorkPlace') {
            $data = WorkPlace::whereId($id)->first();
        } else {
            throw new HttpQueryException();
        }

        $lower_data = Str::lower($request->data);
        if ($data) {
            $data->delete();
            return $this->deleteSuccessfully(trans('messages.' . $lower_data), $lower_data);
        }

        throw new NotFoundHttpException(trans('messages.attr_not_found', ['attr' => trans('messages.' . $lower_data)]));
    }

    public function getManagers(Request $request)
    {

        $data = User::with('perms')
            ->whereRelation('perms', $request->column, $request->id)
            ->get();

        return EmployeeResource::collection($data);
    }

    public function getUsersForManagerAdding(Request $request)
    {
        try {
            $data = User::with('perms')
                ->where('role_id', config('enums.role_columns' . $request->column))
                ->whereDoesntHave('perms', function (Builder $query) use ($request) {
                    $query->where($request->column, $request->id);
                })
                ->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return EmployeeResource::collection($data);
    }

    public function storeUserPerms(PermRequest $request)
    {
        $stored_data = $this->addManager($request->form, $request->column, $request->id);

        return $this->storeSuccessfully(trans('messages.successfully_added', ['attr' => trans('messages.perm')]), EmployeeResource::collection($stored_data));
    }

    public function deleteManager(UserPerm $userperm)
    {
        $userperm->delete();
        return $this->deleteSuccessfully(trans('messages.perm'));
    }

    public function getEmployeesByTree(Request $request, $id)
    {
        try {
            $data = User::with('department', 'company')
                ->where($request->column, $id)
                ->get();
        } catch (\Throwable $e) {
            throw new HttpQueryException();
        }

        return EmployeeResource::collection($data);
    }
}
