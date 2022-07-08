<?php

namespace App\Http\Controllers\Admin\Tree;

use App\Exceptions\CrudException;
use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tree\CompanyRequest;
use App\Http\Requests\Admin\Tree\InventoryRequest;
use App\Http\Requests\Admin\Tree\InventoryTypeRequest;
use App\Http\Resources\Admin\Tree\DepartmentResource;
use App\Http\Resources\Admin\Tree\MainCompanyResource;
use App\Http\Resources\Admin\Tree\InventoryTypeResource;
use App\Http\Resources\Api\InventoryResource as ApiInventoryResource;
use App\Models\Company;
use App\Models\ExpenseType;
use App\Models\Inventory;
use App\Models\InventoryType;
use App\Http\Traits\Manager;
use App\Models\Department;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyController extends Controller
{
    use Manager;

    public function add(CompanyRequest $request)
    {
        try {
            $data = Company::with('departments')->create([
                "title" => $request->title,
                "address" => $request->address,
                "email" => $request->email,
                "city_id" => $request->city_id,
                "musteri_id" => $request->musteri_id,
            ]);

            if ($request->hasFile('logo')) {
                $url = $request->logo->store('company_logos');
                $data->update([
                    "logo" => $url,
                ]);
            }

            $this->addManager($request->permittedUsers, 'company_id', $data->id);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.company')]));
        }

        return $this->storeSuccessfully(trans('messages.company'), []);
    }

    public function get(Company $company)
    {
        return new MainCompanyResource($company->load('city.country'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        try {
            $company->update([
                "title" => $request->title,
                "address" => $request->address,
                "email" => $request->email,
                "city_id" => $request->city_id,
            ]);

            if ($request->hasFile('logo')) {
                $this->deleteOldFile($company->logo);
                $url = $request->logo->store('company_logos');
                $company->update([
                    "logo" => $url,
                ]);
            } else if (!$request->logo) {
                $this->deleteOldFile($company->logo);
                $company->update([
                    "logo" => null,
                ]);
            }
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.company')]));
        }
        return $this->updateSuccessfully(trans('messages.company'), new MainCompanyResource($company->load('city.country')));
    }

    public function addInventoryType(InventoryTypeRequest $request, $id)
    {
        try {
            $data = InventoryType::create([
                'title' => $request->title,
                'company_id' => $id
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.inventory_type')]));
        }

        return $this->storeSuccessfully(trans('messages.inventory_type'), new InventoryTypeResource($data));
    }

    public function getInventoryTypes($id)
    {
        try {
            $data = InventoryType::where('company_id', $id)->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return InventoryTypeResource::collection($data);
    }

    public function deleteInventoryType($company_id, InventoryType $inventorytype)
    {
        $inventorytype->delete();
        return $this->deleteSuccessfully(trans('messages.inventory_type'));
    }

    public function updateInventoryType(InventoryTypeRequest $request, $company_id, InventoryType $inventorytype)
    {
        try {
            $inventorytype->update($request->validated());
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.inventory_type')]));
        }

        return $this->updateSuccessfully(trans('messages.inventory_type'), new InventoryTypeResource($inventorytype));
    }


    public function addInventory(InventoryRequest $request, $id)
    {
        try {
            $data = Inventory::with('type')->create([
                'title' => $request->title,
                'serial' => $request->serial,
                'type_id' => $id
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.inventory')]));
        }

        return $this->storeSuccessfully(trans('messages.inventory'), new ApiInventoryResource($data->load('type')));
    }

    public function getInventories($id)
    {
        try {
            $data = Inventory::with('type')->whereRelation('type', 'company_id', $id)->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return ApiInventoryResource::collection($data);
    }

    public function deleteInventory($company_id, Inventory $inventory)
    {
        $inventory->delete();
        return $this->deleteSuccessfully(trans('messages.inventory'));
    }

    public function updateInventory(InventoryRequest $request, $company_id, Inventory $inventory)
    {
        try {
            $inventory->update($request->validated());
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.inventory')]));
        }

        return $this->updateSuccessfully(trans('messages.inventory'), new ApiInventoryResource($inventory->load('type')));
    }

    public function addExpenseType(InventoryTypeRequest $request, $id)
    {
        try {
            $data = ExpenseType::create([
                'title' => $request->title,
                'company_id' => $id,
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.expense_type')]));
        }

        return $this->storeSuccessfully(trans('messages.expense_type'), new InventoryTypeResource($data));
    }

    public function getExpenseTypes($id)
    {
        try {
            $data = ExpenseType::where('company_id', $id)->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return InventoryTypeResource::collection($data);
    }

    public function deleteExpenseType($company_id, ExpenseType $expensetype)
    {
        $expensetype->delete();
        return $this->deleteSuccessfully(trans('messages.expense_type'));
    }

    public function updateExpenseType(InventoryTypeRequest $request, $company_id, ExpenseType $expensetype)
    {
        try {
            $expensetype->update($request->validated());
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.expense_type')]));
        }

        return $this->updateSuccessfully(trans('messages.expense_type'), new InventoryTypeResource($expensetype));
    }

    public function getDepartments($id)
    {
        try {
            $data = Department::with('company', 'city.country')->where('company_id', $id)->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return DepartmentResource::collection($data);
    }
}
