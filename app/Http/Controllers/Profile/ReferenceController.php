<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\HttpQueryException;
use App\Exceptions\CrudException;
use App\Http\Requests\Profile\ReferenceRequest;
use App\Http\Resources\Profile\ReferenceResource;
use App\Models\Reference;

class ReferenceController extends Controller
{
    public function store(ReferenceRequest $request, $user_id)
    {
        try {
            $data = Reference::create([
                'user_id' => $user_id,
                'full_name' => $request->full_name,
                'work_place_name' => $request->work_place_name,
                'experience' => $request->experience,
                'phone' => $request->phone,
            ]);
        } catch (\Exception $th) {

            throw new CrudException(trans('messages.error_created', ['attr' => trans('messages.reference')]));
        }

        return $this->storeSuccessfully(trans('messages.reference'), new ReferenceResource($data));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReferenceRequest $request, $user_id, Reference $reference)
    {
        try {
            $reference->update([
                'user_id' => $user_id,
                'full_name' => $request->full_name,
                'work_place_name' => $request->work_place_name,
                'experience' => $request->experience,
                'phone' => $request->phone,
            ]);
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return $this->updateSuccessfully(trans('messages.reference'), new ReferenceResource($reference));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, Reference $reference)
    {
        $reference->delete();
        return $this->deleteSuccessfully(trans('messages.reference'));
    }
}
