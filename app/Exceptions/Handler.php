<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use app\Exceptions\HttpQueryException;
use ErrorException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];



    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $modelName = class_basename($e->getModel());
            return response()->json([
                'status' => '404',
                'message' => trans('messages.attr_not_found', ['attr' => trans('model_names.' . $modelName)]),
            ], 404);
        }

        if ($e instanceof QueryException) {
            return response()->json([
                "message" => trans('messages.query_error'),
                "status" => "500",
            ], 500);
        }

        if ($e instanceof ValidationException) {
            return response()->json([
                "status" => "422",
                "message" => trans('messages.validation_error'),
                "data" => $e->errors() ?? null,
            ], 422);
        }

        if ($e instanceof HttpQueryException) {
            return response()->json([
                "message" => $e->getMessage() ?? trans('messages.query_error'),
                "status" => "500",
            ], 500);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'status' => '404',
                'message' => $e->getMessage() ?? trans('not_found'),
            ], 404);
        }

        if ($e instanceof CrudException) {
            return response()->json([
                'status' => '500',
                'message' => $e->getMessage(),
            ], 500);
        }

        if ($e instanceof AuthenticationException) {
            return response()->json([
                'status' => '401',
                'message' => $e->getMessage() ?? trans('messages.auth_error'),
            ], 401);
        }

        return response()->json([
            "message" => trans('messages.error'),
            "status" => "500",
        ], 500);
    }
}
