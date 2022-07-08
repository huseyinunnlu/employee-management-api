<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Reports\StatisticCollection;
use App\Http\Resources\Admin\Reports\StatisticUserResource;
use App\Http\Traits\QueryTrait;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    use QueryTrait;

    private function convertDataToChart($request, $data, $filters)
    {
        return $data->get()->map(function ($user) {
            return $user;
        })
            ->mapToGroups(function ($user) use ($filters, $request) {
                return [$user[$filters[$request->filter]] => $user];
            })
            ->map(function ($group) {
                return count($group);
            });
    }

    public function get(Request $request)
    {
        $filters = [
            'distributionAge' => "age_range",
            'distributionGender' => "gender_title",
            'distributionMarialStatus' => "mariance_status_title",
            'distributionDepartment' => "department_title",
            'workTime' => "formatted_start_date",
            'militaryStatus' => "military_status_title",
        ];

        try {
            $data = User::when($request->role_id, function ($query) use ($request) {
                $query->where('role_id', $request->role_id);
            })
                ->when($request->company_id, function ($query) use ($request) {
                    $query->where('company_id', $request->company_id);
                })
                ->when($request->search, function ($query) use ($request) {
                    $this->filterByFullName($query, $request->search);
                })
                ->orderBy('created_at', 'desc');

            $chart = $this->convertDataToChart($request, $data, $filters);
            $data = $data->paginate($request->page_count ?? 15);
            $data->load('company', 'role');
        } catch (\Exception $th) {
            throw new HttpQueryException();
        }
        return (StatisticUserResource::collection($data))->additional(['chart' => $chart]);
    }
}
