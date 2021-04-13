<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successResponse($statusCode = 200, $data = [])
    {
        return response()->json(
            [
                'status' => 'success',
                'data' => $data
            ],
            $statusCode
        );
    }

    public function errorResponse($statusCode = 422, $message = 'request could not be processed at this time')
    {
        return response()->json(
            [
                'status' => 'failed',
                'message' => $message
            ],
            $statusCode
        );
    }

}
