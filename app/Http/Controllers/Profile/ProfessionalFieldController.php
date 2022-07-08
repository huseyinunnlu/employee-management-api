<?php

namespace App\Http\Controllers\Profile;

use App\Exceptions\CrudException;
use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfessionalFieldRequest;
use App\Http\Resources\Profile\ProfessionalFieldResource;
use App\Models\LocationUser;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfessionalFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id)
    {
        try {
            $data = LocationUser::where('user_id', $user_id)->with('position', 'location.city')->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return ProfessionalFieldResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(ProfessionalFieldRequest $request, $user_id)
    {
        try {
            $data = LocationUser::with('position', 'location.city')->create([
                'user_id' => $user_id,
                'position_id' => $request->position_id,
                'location_id' => $request->location_id,
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_added', ['attr' => trans('messages.professional_field')]));
        }
        return $this->storeSuccessfully(trans('messages.proffesional_field'), new ProfessionalFieldResource($data->load('position', 'location.city')));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfessionalFieldRequest $request, $user_id, $id)
    {
        try {
            $data = LocationUser::whereId($id)->with('position', 'location.city')->first();
            $data->update([
                'user_id' => $user_id,
                'position_id' => $request->position_id,
                'location_id' => $request->location_id,
            ]);
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return $this->updateSuccessfully(trans('messages.proffesional_field'), new ProfessionalFieldResource($data->load('position', 'location.city')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $id)
    {
        $data = LocationUser::whereId($id)->first();

        if ($data) {
            $data->delete();

            return $this->deleteSuccessfully(trans('messages.proffesional_field'));
        }
        throw new NotFoundHttpException(trans('messages.attr_not_found', ['attr' => trans('messages.proffesional_field')]));
    }
}
