<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\HttpQueryException;
use App\Exceptions\CrudException;
use App\Http\Requests\Profile\ForeignLanguageRequest;
use App\Http\Resources\Profile\ForeignLanguageResource;
use App\Models\ForeignLanguage;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ForeignLanguageController extends Controller
{
    public function store(ForeignLanguageRequest $request, $user_id)
    {
        try {
            $data = ForeignLanguage::with('language')->create([
                "user_id" => $user_id,
                "language_id" => $request->language_id,
                "status" => $request->status,
            ]);
        } catch (\Exception $th) {

            throw new CrudException(trans('messages.error_created', ['attr' => trans('messages.foreign_language')]));
        }

        return $this->storeSuccessfully(trans('messages.foreign_language'), new ForeignLanguageResource($data->load('language')));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ForeignLanguageRequest $request, $user_id, ForeignLanguage $foreignlanguage)
    {
        try {
            $foreignlanguage->update([
                "user_id" => $user_id,
                "language_id" => $request->language_id,
                "status" => $request->status,
            ]);
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return $this->updateSuccessfully(trans('messages.foreign_language'), new ForeignLanguageResource($foreignlanguage->load('language')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, ForeignLanguage $foreignlanguage)
    {
        $foreignlanguage->delete();
        return $this->deleteSuccessfully(trans('messages.foreign_language'));
    }
}
