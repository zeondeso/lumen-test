<?php

namespace App\Http\Helper;

class JsendHelper
{
    public function jsend_error($message, $code = null, $data = null, $status = 500, $extraHeaders = [])
    {
        $response = [
            "status" => "error",
            "message" => $message
        ];
        !is_null($code) && $response['code'] = $code;
        !is_null($data) && $response['data'] = $data;

        return response()->json($response, $status, $extraHeaders);
    }

    public function jsend_fail($data, $status = 400, $extraHeaders = [])
    {
        $response = [
            "status" => "fail",
            "data" => $data
        ];

        return response()->json($response, $status, $extraHeaders);
    }

    public function jsend_success($data = [], $status = 200, $extraHeaders = [])
    {
        $response = [
            "status" => "success",
            "data" => $data
        ];

        return response()->json($response, $status, $extraHeaders);
    }
}