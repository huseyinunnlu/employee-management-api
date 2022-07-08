<?php

namespace App\Http\Controllers\Profile;

use App\Exceptions\CrudException;
use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\DebitRequest;
use App\Http\Resources\Api\DebitResource;
use Illuminate\Http\Request;

use App\Models\Debit;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DebitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id)
    {
        try {
            $data = Debit::with('inventory.type')->where('user_id', $user_id)->get();
        } catch (\Throwable $th) {
            throw new HttpQueryException();
        }

        return DebitResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DebitRequest $request, $user_id)
    {
        try {
            $data = Debit::with('inventory.type')->create([
                "user_id" => $user_id,
                "inventory_id" => $request->inventory_id,
                "date" => $request->date,
                "desc" => $request->desc,
                "status" => "debit_employee",
            ]);
            if ($request->hasFile('inventory_photo')) {
                $url = $request->inventory_photo->store('debit_photos');
                $data->update([
                    "inventory_photo" => $url,
                ]);
            }
        } catch (\Exception $th) {
            throw new CrudException(trans('messages.error_created', ['attr' => trans('messages.debit')]));
        }

        return $this->storeSuccessfully(trans('messages.debit'), new DebitResource($data->load('inventory.type')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DebitRequest $request, $user_id, Debit $debit)
    {
        try {
            $debit->update([
                "inventory_id" => $request->inventory_id,
                "date" => $request->date,
                "desc" => $request->desc,
                "status" => $request->status,
            ]);
            if ($request->hasFile('inventory_photo')) {
                $this->deleteOldFile($debit->inventory_photo);
                $url = $request->inventory_photo->store('debit_photos');
                $debit->update([
                    "inventory_photo" => $url,
                ]);
            } else if (!$request->preview) {
                $this->deleteOldFile($debit->inventory_photo);
                $debit->update([
                    "inventory_photo" => null,
                ]);
            }
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.debit')]));
        }
        return $this->updateSuccessfully(trans('messages.debit'), new DebitResource($debit->load('inventory.type')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, Debit $debit)
    {
        $debit->delete();
        return $this->deleteSuccessfully(trans('messages.debit'));
    }
}
