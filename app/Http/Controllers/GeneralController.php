<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    /**
     * Check application status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkStatus()
    {
        return response()->json([
            'status' => true
        ]);
    }
}
