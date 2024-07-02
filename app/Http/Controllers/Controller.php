<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

abstract class Controller
{
    protected function error(string|array $message, $code = 400): JsonResponse
    {
        return $this->jsonResponse($message, $code, false);
    }

    protected function success(string|array|null $message = null, $code = 200): JsonResponse|Response
    {
        if ($code === 204) {
            return response(null, 204);
        }

        return $this->jsonResponse($message, $code);
    }

    private function jsonResponse(string|array $message, int $code, bool $success = true): JsonResponse
    {

        if (is_array($message)) {
            return response()->json($message, $code);
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ], $code);
    }
}
