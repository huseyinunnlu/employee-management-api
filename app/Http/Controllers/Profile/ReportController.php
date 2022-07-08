<?php

namespace App\Http\Controllers\Profile;

use App\Exceptions\CrudException;
use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ReportRequest;
use App\Http\Resources\Profile\DocumentResource;
use App\Http\Resources\Profile\ReportResource;
use App\Models\Document;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReportController extends Controller
{
    public function index($user)
    {
        try {
            $data = Report::where('user_id', $user)->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return ReportResource::collection($data);
    }

    public function store(ReportRequest $request, $user_id)
    {
        try {
            if ($request->hasFile('file')) {
                $url = $request->file->store('reports');
                $title = $request->file->getClientOriginalName();
            }

            $data = Report::create([
                "user_id" => $user_id,
                "desc" => $request->desc,
                "url" => $url,
                "title" => $title,
                "start_date" => Carbon::parse($request->date[0]),
                "end_date" => Carbon::parse($request->date[1]),
                "issuer" => $request->issuer,
            ]);
        } catch (\Exception $th) {

            throw new CrudException(trans('messages.error_created', ['attr' => trans('messages.report')]));
        }

        return $this->storeSuccessfully(trans('messages.report'), new ReportResource($data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReportRequest $request, $user_id, Report $report)
    {
        if ($request->hasFile('file')) {
            $this->deleteOldFile($report->url);
            $url = $request->file->store('reports');
            $title = $request->file->getClientOriginalName();
        }

        try {
            $report->update([
                "user_id" => $user_id,
                "desc" => $request->desc,
                "url" => $url ?? $report->url,
                "title" => $title ?? $report->title,
                "start_date" => Carbon::parse($request->date[0]),
                "end_date" => Carbon::parse($request->date[1]),
                "issuer" => $request->issuer,
            ]);
        } catch (\Throwable $th) {

            throw new HttpQueryException();
        }

        return $this->updateSuccessfully(trans('messages.report'), new ReportResource($report));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Report $report)
    {
        $this->deleteOldFile($report->url);
        $report->delete();

        return $this->deleteSuccessfully(trans('messages.report'));
    }
}
