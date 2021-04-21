<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Config;

class KetuaProgramStudiController extends Controller
{
    public function __construct()
    {
        $this->middleware('token.auth');
        $this->middleware('token.role:ketuaProdi');

    }

    public function dashboard()
    {
    	return view('ketua_program_studi.dashboard');
    }

    public function beasiswa(Request $request)
    {
    	try {
            $client = new Client();             
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/beasiswa/all');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listBeasiswa = $response->result->beasiswa;            
            return view('ketua_program_studi.beasiswa_index', compact('listBeasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }    	
    }

    public function pendaftarBeasiswaProgramStudi($id, Request $request)
    {
    	try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/ketua_program_studi/beasiswa/pendaftar/program_studi', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'beasiswa_id' => $id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listPendaftarProgramStudi = $response->result->pendaftar_program_studi;
            $beasiswaId = $id;
            $jumlahPendaftarProgramStudi = 0;
            foreach ($listPendaftarProgramStudi as $pendaftarProgramStudi) {
                $jumlahPendaftarProgramStudi+=count($pendaftarProgramStudi->pendaftarBeasiswa);                
            }
            return view('ketua_program_studi.beasiswa_pendaftar', compact('listPendaftarProgramStudi', 'beasiswaId', 'jumlahPendaftarProgramStudi'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function seleksiBeasiswaProgramStudi($beasiswa_id, Request $request)
    {
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/ketua_program_studi/beasiswa/seleksi/program_studi', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'beasiswa_id' => $beasiswa_id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listPendaftarProgramStudi = $response->result->pendaftar_program_studi;
            return redirect()->route('ketua_program_studi.dashboard')->with('success', 'Pendaftar beasiswa berhasil diserahkan ke tingkat jurusan');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }
}
