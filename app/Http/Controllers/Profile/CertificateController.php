<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Exceptions\HttpQueryException;
use App\Exceptions\CrudException;
use App\Http\Requests\Profile\CertificateRequest;
use App\Http\Resources\Profile\CertificateResource;
use App\Models\Certificate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CertificateController extends Controller
{
    public function store(CertificateRequest $request, $user_id)
    {
        try {
            $data = Certificate::create([
                "user_id" => $user_id,
                "title" => $request->title,
                "issuer" => $request->issuer,
                "giving_date" => Carbon::parse($request->giving_date)->format('Y-m-d'),
                "finish_date" => Carbon::parse($request->finish_date)->format('Y-m-d') ?? null,
            ]);
        } catch (\Exception $th) {
            throw new CrudException(trans('messages.error_created', ['attr' => trans('messages.certificate')]));
        }

        return $this->storeSuccessfully(trans('messages.certificate'), new CertificateResource($data));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CertificateRequest $request, $user_id, Certificate $certificate)
    {
        try {
            $certificate->update([
                "user_id" => $user_id,
                "title" => $request->title,
                "issuer" => $request->issuer,
                "giving_date" => Carbon::parse($request->giving_date)->format('Y-m-d'),
                "finish_date" => $request->finish_date ? Carbon::parse($request->finish_date)->format('Y-m-d') : null,
            ]);
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return $this->updateSuccessfully(trans('messages.certificate'), new CertificateResource($certificate));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, Certificate $certificate)
    {
        $certificate->delete();
        return $this->deleteSuccessfully(trans('messages.certificate'));
    }
}
