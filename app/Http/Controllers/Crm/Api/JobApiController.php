<?php

namespace App\Http\Controllers\Crm\Api;

use App\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobApiController extends Controller
{
    /**
     * Return Jobs based on Client ID.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function client()
    {
        $jobs = Job::client(request('id'))->get();

        return response()->json([
            'jobs' => $jobs
        ]);
    }
}
