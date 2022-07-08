<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Reports\DebitReportResource;
use App\Http\Traits\QueryTrait;
use App\Models\Debit;
use Illuminate\Http\Request;

class DebitReportController extends Controller
{
    use QueryTrait;

    public function get(Request $request)
    {

        $data = Debit::with('user.company.department', 'inventory.type')
            ->when($request->company_id, function ($query) use ($request) {
                $query->whereRelation('user', 'company_id', $request->company_id);
            })
            ->when($request->department_id, function ($query) use ($request) {
                $query->whereRelation('user', 'department_id', $request->department_id);
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->inventory_id, function ($query) use ($request) {
                $query->where('inventory_id', $request->inventory_id);
            })
            ->when($request->inventory_type, function ($query) use ($request) {
                $query->whereRelation('inventory', 'type_id', $request->inventory_type);
            })
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                //This function filtering datas by start date and end date. This function coming from Query trait
                $this->filterOneColumnDate($query, $request);
            })
            ->paginate($request->page_count ?? 15);


        return DebitReportResource::collection($data);
    }
}
