<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CLients;

class ClientController extends Controller
{
    public function getClients() {
        $data = Clients::all();

        return response()->json($data);
    }
}
