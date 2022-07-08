<?php

namespace App\Http\Controllers\Profile;

use App\Exceptions\CrudException;
use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\DocumentRequest;
use App\Http\Resources\Profile\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DocumentController extends Controller
{
    public function store(DocumentRequest $request, $user_id)
    {
        try {
            if ($request->hasFile('file')) {
                $url = $request->file->store('documents');
                $title = $request->file->getClientOriginalName();
            }

            $data = Document::with('type')->create([
                "user_id" => $user_id,
                "type_id" => $request->type_id,
                "desc" => $request->desc,
                "url" => $url,
                "title" => $title,
                "is_see_document" => $request->is_see_document,
            ]);
        } catch (\Exception $th) {
            throw new CrudException(trans('messages.error_created', ['attr' => trans('messages.document')]));
        }

        return $this->storeSuccessfully(trans('messages.document'), new DocumentResource($data->load('type')));
    }

    public function index($user)
    {
        try {
            $data = Document::with('type')->where('user_id', $user)->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return DocumentResource::collection($data->load('type'));
    }

    public function update(DocumentRequest $request, $user_id, $id)
    {
        $data = Document::with('type')->whereId($id)->first();

        if (!$data) {
            throw new NotFoundHttpException(trans('messages.attr_not_found', ['attr' => trans('messages.document')]));
        }

        if ($request->hasFile('file')) {
            $this->deleteOldFile($data->url);
            $url = $request->file->store('documents');
            $title = $request->file->getClientOriginalName();
        }

        try {
            $data->update([
                "user_id" => $user_id,
                "type_id" => $request->type_id,
                "desc" => $request->desc,
                "url" => $url ?? $data->url,
                "title" => $title ?? $data->title,
                "is_see_document" => $request->is_see_document,
            ]);
        } catch (\Throwable $th) {

            throw new HttpQueryException();
        }

        return $this->updateSuccessfully(trans('messages.document'), new DocumentResource($data->load('type')));
    }

    public function destroy($user_id, $id)
    {
        $data = Document::find($id);

        if ($data) {
            $data->delete();

            return $this->deleteSuccessfully(trans('messages.document'));
        }
        throw new NotFoundHttpException(trans('messages.attr_not_found', ['attr' => trans('messages.document')]));
    }
}
