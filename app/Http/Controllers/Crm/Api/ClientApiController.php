<?php

namespace App\Http\Controllers\Crm\Api;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientApiController extends Controller
{
    /**
     * Return index of all Enquiries on database.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $clients = Client::all();

        return response()->json([
            'clients' => $clients
        ], 200);
    }
}
