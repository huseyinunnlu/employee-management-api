<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\InventoryResource;
use App\Http\Resources\ApiSelectDataResource;
use App\Http\Resources\Select\SelectJobResource;
use App\Http\Resources\Select\SelectUserResource;
use App\Http\Resources\SelectManagerResource;
use App\Models\AbsenceType;
use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use App\Models\Nation;
use App\Models\Position;
use App\Models\Role;
use App\Models\Company;
use App\Models\Department;
use App\Models\DocumentType;
use App\Models\EmployeerBranch;
use App\Models\ExpenseType;
use App\Models\Job;
use App\Models\Musteri;
use App\Models\User;
use App\Models\WorkPlace;
use App\Models\InventoryType;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ApiDataController extends Controller
{
    public function getRoles()
    {
        try {
            $roles = Role::with('titles')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return ApiSelectDataResource::collection($roles);
    }

    public function getCountries()
    {
        try {
            $data = Country::with('titles')
                ->whereHas('city')
                ->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return ApiSelectDataResource::collection($data);
    }

    public function getCities(Request $request)
    {
        try {
            $data = City::where('country_id', $request->country_id)->select('id', 'title')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return response()->json($data);
    }

    public function getNations()
    {
        try {
            $data = Nation::with('titles')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return ApiSelectDataResource::collection($data);
    }

    public function getLanguages()
    {
        try {
            $data = Language::select('id', 'title', 'code')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return response()->json($data, 200);
    }

    public function getJobs(Request $request)
    {
        try {
            $data = Job::with('titles')
                ->whereRelation('titles', 'lang_code', App::currentLocale())
                ->whereRelation('titles', 'title', 'like', '%' . $request->search . '%')
                ->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return SelectJobResource::collection($data);
    }

    public function getMusteris()
    {
        try {
            $data = Musteri::select('id', 'title')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return response()->json($data, 200);
    }

    public function getCompanies(Request $request)
    {
        try {
            $data = Company::when($request->musteri_id, function ($query) use ($request) {
                $query->where('musteri_id', $request->musteri_id);
            })->select('id', 'title')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return response()->json($data, 200);
    }

    public function getEmployeerBranches(Request $request)
    {
        try {
            $data = EmployeerBranch::where('musteri_id', $request->musteri_id)->select('id', 'employeer_title')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return response()->json($data, 200);
    }

    public function getDepartments(Request $request)
    {
        try {
            $data = Department::where('company_id', $request->company_id)->select('id', 'title')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return response()->json($data, 200);
    }

    public function getWorkPlaces(Request $request)
    {
        try {
            $data = WorkPlace::where('department_id', $request->department_id)->select('id', 'title')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return response()->json($data, 200);
    }

    public function getPositions(Request $request)
    {
        try {
            $data = Position::where('department_id', $request->department_id)->with('titles')->select('id')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return ApiSelectDataResource::collection($data);
    }

    public function getManagers(Request $request)
    {
        try {
            $data = User::with('role')->where(function ($query) use ($request) {
                $role_id = null;
                if ($request->role_id == 4) {
                    $role_id = [1, 2, 3, 5, 6, 7];
                } else if ($request->role_id == 3) {
                    $role_id = [1, 2, 6];
                } else if ($request->role_id == 5 || 7) {
                    $role_id = [1, 2, 3, 6];
                }
                $query->whereIn('role_id', $role_id);
            })->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return SelectManagerResource::collection($data);
    }

    public function getUsers(Request $request)
    {
        try {
            $data = User::with('role')
                ->when($request->company_id, function ($query) use ($request) {
                    $query->where('company_id', $request->company_id);
                })
                ->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return SelectUserResource::collection($data);
    }


    public function getPermsByRole(Request $request)
    {
        $role_id = $request->role_id;
        $column_id = $request->column_id;
        $column_name = $request->column_name;

        try {
            if ($role_id == 5 && $column_name == 'company') {
                $data = Company::with('departments.work_places')->whereId($column_id)->first();
            }
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return response()->json($data);
    }

    public function getInventoryTypes(Request $request)
    {
        try {
            $data = InventoryType::where('company_id', $request->company_id)->select('id', 'title')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return response()->json($data);
    }

    public function getInventoriesByType(Request $request)
    {
        try {
            $data = Inventory::with('type')->where('type_id', $request->type_id)->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return InventoryResource::collection($data);
    }

    public function getDocumentTypes(Request $request)
    {
        try {
            $data = DocumentType::with('titles')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return ApiSelectDataResource::collection($data);
    }

    public function getAbsenceTypes()
    {
        try {
            $data = AbsenceType::with('titles')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return ApiSelectDataResource::collection($data);
    }

    public function getExpenseTypes(Request $request)
    {
        try {
            $data = ExpenseType::where('company_id', $request->company_id)->select('id', 'title')->get();
        } catch (\Throwable $e) {
            return response()->json([], 500);
        }

        return response()->json($data, 200);
    }
}
