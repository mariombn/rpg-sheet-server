<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param bool $status
     * @param array $data
     * @param string $message
     * @param int $httpcode
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseJson($status, $data = [], $message = '', $httpcode = 200)
    {
        /** \Exception $message */
        if ($message instanceof \Exception) {
            $message = $message->getMessage();
        }

        $response = [
            'success' => $status,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response, $httpcode);
    }
}
