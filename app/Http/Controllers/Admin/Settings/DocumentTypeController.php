<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Exceptions\CrudException;
use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tree\TitleUpdateRequest;
use App\Http\Requests\Admin\Settings\DocumentTypeRequest;
use App\Http\Resources\Admin\Settings\DocumentTypeResource;
use App\Models\DocumentType;
use App\Models\DocumentTypeTitle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DocumentTypeController extends Controller
{
    public function get(Request $request)
    {
        try {
            $data = DocumentType::with('titles')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            throw new HttpQueryException();
        }

        return DocumentTypeResource::collection($data);
    }

    public function store(DocumentTypeRequest $request)
    {
        try {
            $document_type_data = DocumentType::with('titles')->create();
            foreach ($request->documentTypes as $item) {
                DocumentTypeTitle::create([
                    "type_id" => $document_type_data->id,
                    "lang_code" => $item['lang_code'],
                    "title" => $item['title'],
                ]);
            }
        } catch (\Throwable $e) {
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.document_type')]));
        }
        return $this->storeSuccessfully(trans('messages.document_type'), new DocumentTypeResource($document_type_data->load('titles')));
    }

    public function update(DocumentTypeRequest $request, DocumentType $documenttype)
    {
        try {
            foreach ($request->documentTypes as $item) {
                $title_data = DocumentTypeTitle::whereId($item['id'] ?? null)->first();
                if (!$title_data) {
                    DocumentTypeTitle::create([
                        "type_id" => $documenttype->id,
                        "lang_code" => $item['lang_code'],
                        "title" => $item['title'],
                    ]);
                } else {
                    $title_data->update([
                        "type_id" => $documenttype->id,
                        "lang_code" => $item['lang_code'],
                        "title" => $item['title'],
                    ]);
                }
            }
        } catch (\Throwable $e) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.document_type')]));
        }
        return $this->updateSuccessfully(trans('messages.document_type'), new DocumentTypeResource($documenttype->load('titles')));
    }

    public function destroy(DocumentType $documenttype)
    {
        $documenttype->delete();
        return $this->deleteSuccessfully(trans('messages.document_type'));
    }

    public function destroyDocumentTypeTitle($document_type_id, DocumentTypeTitle $documenttypetitle)
    {
        $documenttypetitle->delete();
        return $this->deleteSuccessfully(trans('messages.document_type_title'));
    }

    public function updateDocumentTypeTitle(TitleUpdateRequest $request, DocumentType $documenttype, DocumentTypeTitle $documenttypetitle)
    {
        try {
            $documenttypetitle->update([
                'title' => $request->title,
            ]);
        } catch (\Throwable $e) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.document_type')]));
        }
        return $this->updateSuccessfully(trans('messages.document_type_title'), new DocumentTypeResource($documenttype->load('titles')));
    }
}
