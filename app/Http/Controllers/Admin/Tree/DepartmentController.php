<?php

namespace App\Http\Controllers\Admin\Tree;

use App\Exceptions\CrudException;
use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tree\TitleUpdateRequest;
use App\Http\Requests\Admin\Tree\DepartmentRequest;
use App\Http\Requests\Admin\Tree\PositionRequest;
use App\Http\Resources\Admin\Tree\DepartmentResource;
use App\Http\Resources\Admin\Tree\PositionResource;
use App\Http\Traits\Manager;
use App\Models\Department;
use App\Models\Position;
use App\Models\PositionTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    use Manager;

    public function add(DepartmentRequest $request)
    {
        try {
            $data = Department::create([
                "title" => $request->title,
                "city_id" => $request->city_id,
                "mountly_holiday" => $request->mountly_holiday,
                "daily_work_hour" => $request->daily_work_hour,
                "overtime_rate" => $request->overtime_rate,
                "overtime_type" => $request->overtime_type,
                "food_fee_tax" => $request->food_fee_tax,
                "road_fee_tax" => $request->road_fee_tax,
                "company_id" => $request->company_id,
            ]);

            $this->addManager($request->permittedUsers, 'department_id', $data->id);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error.added', ['attr' => trans('messages.department')]));
        }

        return $this->storeSuccessfully(trans('messages.department'), []);
    }

    public function get(Department $department)
    {
        return new DepartmentResource($department->load('company', 'city.country'));
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        try {
            $department->update($request->validated());
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.department')]));
        }
        return $this->updateSuccessfully(trans('messages.department'), new DepartmentResource($department->load('company', 'city.country')));
    }

    public function addPosition(PositionRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = Position::with('titles', 'department')->create([
                'department_id' => $id
            ]);

            foreach ($request->positions as $position) {
                $title = PositionTitle::create([
                    'position_id' => $data->id,
                    'title' => $position['title'],
                    'lang_code' => $position['lang_code'],
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.position')]));
        }

        DB::commit();
        return $this->storeSuccessfully(trans('messages.position'), new PositionResource($data->load('titles', 'department')));
    }

    public function getPositions($id)
    {
        try {
            $data = Position::with('titles', 'department')->where('department_id', $id)->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return PositionResource::collection($data);
    }

    public function deletePosition($department_id, Position $position)
    {
        $position->delete();
        return $this->deleteSuccessfully(trans('messages.position'));
    }

    public function updatePosition(PositionRequest $request, $department_id, Position $position)
    {
        try {
            foreach ($request->positions as $item) {
                $title_data = PositionTitle::whereId($item['id'] ?? null)->first();
                if (!$title_data) {
                    PositionTitle::create([
                        "position_id" => $position->id,
                        "lang_code" => $item['lang_code'],
                        "title" => $item['title'],
                    ]);
                } else {
                    $title_data->update([
                        "position_id" => $position->id,
                        "lang_code" => $item['lang_code'],
                        "title" => $item['title'],
                    ]);
                }
            }
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.position')]));
        }

        return $this->updateSuccessfully(trans('messages.position'), new PositionResource($position->load('titles', 'department')));
    }

    public function deletePositionTitle($department_id, $id, PositionTitle $positiontitle)
    {

        $positiontitle->delete();
        return $this->deleteSuccessfully(trans('messages.position'));
    }

    public function updatePositionTitle(TitleUpdateRequest $request, $department_id, Position $position, PositionTitle $positiontitle)
    {
        try {
            $positiontitle->update([
                'title' => $request->title,
            ]);
        } catch (\Throwable $e) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.position')]));
        }
        return $this->updateSuccessfully(trans('messages.position'), new PositionResource($position->load('titles', 'department')));
    }
}
