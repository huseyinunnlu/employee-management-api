<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\HttpQueryException;
use App\Exceptions\CrudException;
use App\Http\Requests\Profile\WorkExperienceRequest;
use App\Http\Resources\Profile\WorkExperienceResource;
use App\Models\WorkExperience;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WorkExperienceController extends Controller
{
    public function store(WorkExperienceRequest $request, $user_id)
    {
        try {
            $data = WorkExperience::create([
                'user_id' => $user_id,
                'work_place_name' => $request->work_place_name,
                'experience' => $request->experience,
                'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                'leave_date' => $request->leave_date ? Carbon::parse($request->leave_date)->format('Y-m-d') :  null,
                'leave_reason' => $request->leave_reason,
            ]);
        } catch (\Exception $th) {
            throw new CrudException(trans('messages.error_created', ['attr' => trans('messages.work_experience')]));
        }

        return $this->storeSuccessfully(trans('messages.work_experience'), new WorkExperienceResource($data));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkExperienceRequest $request, $user_id, WorkExperience $workexperience)
    {
        try {
            $workexperience->update([
                'user_id' => $user_id,
                'work_place_name' => $request->work_place_name,
                'experience' => $request->experience,
                'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                'leave_date' => $request->leave_date ? Carbon::parse($request->leave_date)->format('Y-m-d') :  null,
                'leave_reason' => $request->leave_reason,
            ]);
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return $this->updateSuccessfully(trans('messages.work_experience'), new WorkExperienceResource($workexperience));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, WorkExperience $wokrexperience)
    {
        $wokrexperience->delete();
        return $this->deleteSuccessfully(trans('messages.work_experience'));
    }
}
