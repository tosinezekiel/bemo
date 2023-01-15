<?php

namespace App\Traits;

use App\Constants\HttpStatus;

trait HasResponse {
    public function success($message = HttpStatus::DEFAULT_MESSAGE, $data = HttpStatus::DEFAULT_PAYLOAD, $status = HttpStatus::OK)
    {
        return response()->json([
            "status" => true,
            "message" => $message,
            "data" => $data
        ], $status);
    }

    public function error($message = HttpStatus::DEFAULT_MESSAGE, $data = HttpStatus::DEFAULT_PAYLOAD, $status = HttpStatus::INTERNAL_SERVER_ERROR)
    {
        return response()->json([
            "status" => false,
            "message" => $message,
            "data" => $data
        ], $status);
    }
}