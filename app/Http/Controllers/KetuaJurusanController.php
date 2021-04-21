<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Config;

class KetuaJurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('token.auth');
        $this->middleware('token.role:ketuaJurusan');

    }

    public function dashboard()
    {
    	return view('ketua_jurusan.dashboard');
    }

    public function beasiswa(Request $request)
    {
    	try {
            $client = new Client();             
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/beasiswa/all');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listBeasiswa = $response->result->beasiswa;            
            return view('ketua_jurusan.beasiswa_index', compact('listBeasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }    	
    }

    public function pendaftarBeasiswaJurusan($id, Request $request)
    {
    	try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/ketua_jurusan/beasiswa/pendaftar/jurusan', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'beasiswa_id' => $id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listPendaftarJurusan = $response->result->pendaftar_jurusan;            
            $beasiswaId = $id;
            $jumlahPendaftarJurusan = 0;            
            foreach ($listPendaftarJurusan as $pendaftarJurusan) {                
                $jumlahPendaftarJurusan+=count($pendaftarJurusan->pendaftarBeasiswa);                
            }
            return view('ketua_jurusan.beasiswa_pendaftar', compact('listPendaftarJurusan', 'beasiswaId', 'jumlahPendaftarJurusan'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function seleksiBeasiswaJurusan($beasiswa_id, Request $request)
    {
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/ketua_jurusan/beasiswa/seleksi/jurusan/', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'beasiswa_id' => $beasiswa_id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listPendaftarProgramStudi = $response->result->pendaftar_jurusan;
            return redirect()->route('ketua_jurusan.dashboard')->with('success', 'Pendaftar beasiswa berhasil diserahkan ke tingkat jurusan');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }
}
