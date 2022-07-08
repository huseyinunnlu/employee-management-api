<?php

namespace App\Http\Controllers;

use App\Http\Resources\Auth\UserResource;
use app\Http\Traits\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function loginSuccessfully($user, $token)
    {
        return response()->json([
            'message' => trans('messages.successfully_login'),
            'token' => $token,
            'user' => new UserResource($user),
        ], 200);
    }

    public function logoutSuccessfully()
    {
        return response()->json([
            'message' => trans('messages.successfully_logged_out'),
            'status' => 200
        ], 200);
    }

    public function storeSuccessfully($attr, $data)
    {
        return response()->json([
            'message' => trans('messages.successfully_added', ['attr' => $attr]),
            'status' => 200,
            'data' => $data,
        ], 200);
    }


    public function updateSuccessfully($attr, $data)
    {
        return response()->json([
            'message' => trans('messages.successfully_updated', ['attr' => $attr]),
            'status' => 200,
            'data' => $data,
        ], 200);
    }

    public function deleteSuccessfully($attr, $data = [])
    {
        return response()->json([
            'message' => trans('messages.successfully_deleted', ['attr' => $attr]),
            'data' => $data,
            'status' => 200,
        ], 200);
    }

    public function changeStatusSuccessfully($attr)
    {
        return response()->json([
            'message' => trans('messages.successfully_updated', ['attr' => $attr]),
            'status' => 200,
        ], 200);
    }

    public function deleteOldFile($url)
    {
        $url != '/blank.png' ? Storage::delete($url) : '';
    }
}
