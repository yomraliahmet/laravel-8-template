<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro("redirectToJson", function(string $url, int $status = 200, array $headers = [], int $options = 0): JsonResponse {
            return response()->json([
                'url'    => $url,
            ], $status, $headers, $options);
        });

        Response::macro("success", function($data = [], int $status = 200, array $headers = [], int $options = 0): JsonResponse {
            if(is_array($data)) $message = $data["message"] ?? trans('messages.common.success_message');
            if(!is_array($data)) $message = trans($data);
            $arr = [
                'code'    => $data["code"] ?? "success",
                'title'   => $data["title"] ?? trans('messages.common.success_title'),
                'message' => $message,
                'data'    => $data["data"] ?? []
            ];

            if(count($arr["data"]) == 0) unset($arr["data"]);

            if(isset($data["token"])) $arr["token"] = $data["token"];
            return response()->json($arr, $status, $headers, $options);
        });

        Response::macro("error", function($data = [], int $status = 400, array $headers = [], int $options = 0): JsonResponse{

            if(is_array($data)) $message = $data["message"] ?? trans('errors.common.error_message');
            if(!is_array($data)) $message = trans($data);

            $arr = [
                'code'    => $data["code"] ?? "error",
                'title'   => $data["title"] ?? trans('errors.common.error_title'),
                'message' => $message,
                'data'    => $data["data"] ?? []
            ];

            if(count($arr["data"]) == 0) unset($arr["data"]);

            return response()->json($arr, $status, $headers, $options);
        });
    }
}
