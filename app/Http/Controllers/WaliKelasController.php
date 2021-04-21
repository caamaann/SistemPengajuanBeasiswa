<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Config;

class WaliKelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('token.auth');
        $this->middleware('token.role:waliKelas');

    }

    public function dashboard()
    {
    	return view('wali_kelas.dashboard');
    }

    public function beasiswa(Request $request)
    {
    	try {
            $client = new Client();             
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/beasiswa/all');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listBeasiswa = $response->result->beasiswa;            
            return view('wali_kelas.beasiswa_index', compact('listBeasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }    	
    }

    public function pendaftarBeasiswaKelas($id, Request $request)
    {
    	try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/wali_kelas/beasiswa/pendaftar/kelas', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                	'beasiswa_id' => $id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listPendaftarKelas = $response->result->pendaftar_kelas;
            return view('wali_kelas.beasiswa_pendaftar', compact('listPendaftarKelas'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function penilaianBeasiswa($beasiswa_id, $nim, Request $request)
    {    	
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/wali_kelas/beasiswa/pendaftar/kelas/sertifikat', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'nim' => $nim
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $sertifikatMahasiswa = $response->result->sertifikat;
            return view('wali_kelas.beasiswa_penilaian', compact('beasiswa_id', 'nim', 'sertifikatMahasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
        
    }

    public function penilaianBeasiswaSubmit($beasiswa_id, $nim, Request $request)
    {
        $this->validate($request, [            
            'skor_prestasi' => 'required|integer|gte:0',
            'skor_perilaku' => 'required|integer|gte:0|lte:4',
            'skor_organisasi' => 'required|integer|gte:0',            
        ]);

        // echo json_encode($request->except('_token'));
        try {
            $formParams = $request->except('_token');
            $formParams['nim'] = $nim;
            $formParams['beasiswa_id'] = $beasiswa_id;
            // echo json_encode($formParams);
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->put(Config::get('constants.api_base_url').'api/wali_kelas/beasiswa/pendaftar/kelas/penilaian', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $formParams
            ]);
            $jsonResponse = $httpRequest->getBody();
            echo json_encode($jsonResponse);
            $response = json_decode($jsonResponse);
            $hasil_penilaian = $response->result->hasil_penilaian;
            return redirect()->route('wali_kelas.dashboard')->with('success', 'Penilaian berhasil');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }
}
