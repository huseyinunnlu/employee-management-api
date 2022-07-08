<?php

namespace App\Http\Controllers\Profile;

use App\Exceptions\CrudException;
use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\EducationInfoRequest;
use App\Http\Resources\EducationInfoResource;
use App\Models\EducationInfo;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EducationInfoController extends Controller
{
    public function store(EducationInfoRequest $request, $user_id)
    {
        try {
            if ($request->hasFile('file')) {
                $url = $request->file->store('certificate');
                $title = $request->file->getClientOriginalName();
            }

            $data = EducationInfo::create([
                "user_id" => $user_id,
                "url" => $url ?? null,
                "title" => $title ?? null,
                "status" => $request->status,
                "department" => $request->department,
                "certificate_grade" => $request->certificate_grade,
                "graduated_school" => $request->graduated_school,
                "start_year" => $request->start_year,
                "finish_year" => $request->finish_year,
            ]);
        } catch (\Exception $th) {
            throw new CrudException(trans('messages.error_created', ['attr' => trans('messages.education_info')]));
        }

        return $this->storeSuccessfully(trans('messages.education_info'), new EducationInfoResource($data));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EducationInfoRequest $request, $user_id, EducationInfo $educationinfo)
    {
        try {
            if ($request->hasFile('file')) {
                $this->deleteOldFile($educationinfo->url);
                $url = $request->file->store('certificate');
                $title = $request->file->getClientOriginalName();
            }

            $educationinfo->update([
                "user_id" => $user_id,
                "status" => $request->status,
                "url" => $url ?? $educationinfo->url,
                "title" => $title ?? $educationinfo->title,
                "department" => $request->department,
                "certificate_grade" => $request->certificate_grade,
                "graduated_school" => $request->graduated_school,
                "start_year" => $request->start_year,
                "finish_year" => $request->finish_year,
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.education_info')]));
        }

        return $this->updateSuccessfully(trans('messages.education_info'), $educationinfo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, EducationInfo $educationinfo)
    {
        $educationinfo->delete();
        return $this->deleteSuccessfully(trans('messages.education_info'));
    }
}
