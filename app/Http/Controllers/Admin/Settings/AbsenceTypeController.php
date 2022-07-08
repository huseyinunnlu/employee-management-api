<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Exceptions\CrudException;
use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\AbsenceTypeRequest;
use App\Http\Requests\Admin\Tree\TitleUpdateRequest;
use App\Http\Resources\Admin\Settings\DocumentTypeResource;
use App\Models\AbsenceType;
use App\Models\AbsenceTypeTitle;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AbsenceTypeController extends Controller
{
    public function get(Request $request)
    {
        try {
            $data = AbsenceType::with('titles')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            throw new HttpQueryException();
        }

        return DocumentTypeResource::collection($data);
    }

    public function store(AbsenceTypeRequest $request)
    {
        try {
            $absence_type_data = AbsenceType::with('titles')->create();
            foreach ($request->absenceTypes as $item) {
                AbsenceTypeTitle::create([
                    "type_id" => $absence_type_data->id,
                    "lang_code" => $item['lang_code'],
                    "title" => $item['title'],
                ]);
            }
        } catch (\Throwable $e) {
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.absence_type')]));
        }
        return $this->storeSuccessfully(trans('messages.absence_type'), new DocumentTypeResource($absence_type_data->load('titles')));
    }

    public function update(AbsenceTypeRequest $request, AbsenceType $absencetype)
    {
        try {
            foreach ($request->absenceTypes as $item) {
                $title_data = AbsenceTypeTitle::whereId($item['id'] ?? null)->first();
                if (!$title_data) {
                    AbsenceTypeTitle::create([
                        "type_id" => $absencetype->id,
                        "lang_code" => $item['lang_code'],
                        "title" => $item['title'],
                    ]);
                } else {
                    $title_data->update([
                        "type_id" => $absencetype->id,
                        "lang_code" => $item['lang_code'],
                        "title" => $item['title'],
                    ]);
                }
            }
        } catch (\Throwable $e) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.absence_type')]));
        }
        return $this->updateSuccessfully(trans('messages.absence_type'), new DocumentTypeResource($absencetype->load('titles')));
    }

    public function destroy(AbsenceType $absencetype)
    {
        $absencetype->delete();
        return $this->deleteSuccessfully(trans('messages.absence_type'));
    }

    public function destroyAbsenceTypeTitle($type_id, AbsenceTypeTitle $absencetypetitle)
    {
        $absencetypetitle->delete();
        return $this->deleteSuccessfully(trans('messages.absence_type_title'));
    }

    public function updateAbsenceTypeTitle(TitleUpdateRequest $request, AbsenceType $absencetype, AbsenceTypeTitle $absencetypetitle)
    {
        try {
            $absencetypetitle->update([
                'title' => $request->title,
            ]);
        } catch (\Throwable $e) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.absence_type_title')]));
        }

        return $this->updateSuccessfully(trans('messages.absence_type_title'), new DocumentTypeResource($absencetype->load('titles')));
    }
}
