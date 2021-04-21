<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Config;

class BeasiswaController extends Controller
{
	public function __construct()
    {
        $this->middleware('token.auth')->except('index', 'show', 'getActiveBeasiswa');
        $this->middleware('token.role:pd3')->except('index', 'show', 'getActiveBeasiswa');

    }

    public function index(){
        try {
            $client = new Client();             
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/beasiswa/all');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listBeasiswa = $response->result->beasiswa;            
            return view('beasiswa.index', compact('listBeasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function show($id)
    {               
        try {
            $client = new Client();             
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/beasiswa/', [
	            'query' => [
	                'beasiswa_id' => $id,
	            ],
        	]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $beasiswa = $response->result->beasiswa;            
            return view('beasiswa.show', compact('beasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function getActiveBeasiswa(){            	
        try {
            $client = new Client();             
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/beasiswa/active');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listBeasiswa = $response->result->beasiswa;            
            return view('beasiswa.index', compact('listBeasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }
    
}
