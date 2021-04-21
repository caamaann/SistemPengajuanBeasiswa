<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Config;

class AuthenticationController extends Controller
{    
    public function __construct()
    {        
        $this->middleware('token.auth')->only('logout');        
    }

    public function loginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $client = new Client();
        $httpRequest = $client->post(Config::get('constants.api_base_url').'api/login', [
            'form_params' => [
                'username' => $request->username,
                'password' => $request->password,                
            ],            
        ]);
        $jsonResponse = $httpRequest->getBody();        
        $response = json_decode($jsonResponse);
        if($response->message == "Wrong credentials"){
            return redirect()->route('auth.login_form')->with('fail', 'Username atau password salah');

        }else{            
            $request->session()->put('credential', $response->result->credential);
            return redirect()->route('home');
        }
    }

    public function logout(Request $request){        
        $token = $request->session()->get('credential')->token;        
        $client = new Client();
        $httpRequest = $client->post(Config::get('constants.api_base_url').'api/logout', [
            'headers' => [
                'Authorization' => 'bearer ' . $token,
            ],            
        ]);
        $request->session()->forget('credential');
        return redirect()->route('auth.login_form');
    }
}