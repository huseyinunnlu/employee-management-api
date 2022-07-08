<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Reports\DocumentReportResource;
use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DocumentReportController extends Controller
{
    public function get(Request $request)
    {
        //This function converting 'true' or 'false' string to boolean
        $is_have = convert_string_to_boolean($request->is_have);
        try {
            $data = User::with(['document' => function ($query) use ($request) {
                $query->where('type_id', $request->type_id);
            }, 'company', 'department'])
                //Coming from User model
                ->getUsersByDocument($is_have, $request)
                ->when($request->company_id, function ($query) use ($request) {
                    $query->where('company_id', $request->company_id);
                })
                ->when($request->department_id, function ($query) use ($request) {
                    $query->whereRelation('user', 'department_id', $request->department_id);
                })
                ->paginate($request->page_count ?? 15);
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return DocumentReportResource::collection($data);
    }
}
