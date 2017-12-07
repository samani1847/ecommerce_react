<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lib\ClientInterface as Client;

class AuthController extends Controller
{

    protected $client;

    public function __construct(Client $client){
        $this->client = $client;

    }

    public function login(Request $request)
    {

        $response = $this->client->login($request->username, $request->password);
      
        return  response()->json($response);
    }
    
}
