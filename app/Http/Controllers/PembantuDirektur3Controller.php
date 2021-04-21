<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Config;

class PembantuDirektur3Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('token.auth');
        $this->middleware('token.role:pd3');

    }

    public function dashboard()
    {
    	return view('pembantu_direktur_3.dashboard');
    }

    public function beasiswa()
    {
        try {
            $client = new Client();             
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/beasiswa/all');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listBeasiswa = $response->result->beasiswa;            
            return view('pembantu_direktur_3.beasiswa_index', compact('listBeasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }       
    }

    public function createBeasiswa()
    {       
        return view('beasiswa.create');
    }

    public function storeBeasiswa(Request $request){
        $this->validate($request, [
            'nama' => 'required|string',
            'deskripsi' => 'required|string',            
            'awal_pendaftaran' => 'required|date|before:akhir_pendaftaran',
            'akhir_pendaftaran' => 'required|date|after:awal_pendaftaran',
            'awal_penerimaan' => 'required|date|after:awal_pendaftaran|after:akhir_pendaftaran|before:akhir_penerimaan',
            'akhir_penerimaan' => 'required|date|after:awal_pendaftaran|after:akhir_pendaftaran|after:awal_penerimaan',
            'biaya_pendidikan_per_semester' => 'required|integer',
            'penghasilan_orang_tua_maksimal' => 'required|integer',
            'ipk_minimal' => 'required'            
        ]);        
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/pembantu_direktur_3/beasiswa/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $request->except('_token')
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $mahasiswa = $response->result->beasiswa;
            return redirect()->route('pembantu_direktur_3.beasiswa')->with('success', 'Beasiswa berhasil ditambahkan');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function editBeasiswa($id)
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
            return view('beasiswa.edit', compact('beasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function updateBeasiswa($id, Request $request)
    {
        $this->validate($request, [            
            'nama' => 'string',
            'deskripsi' => 'string',            
            'awal_pendaftaran' => 'date|before:akhir_pendaftaran',
            'akhir_pendaftaran' => 'date|after:awal_pendaftaran',
            'awal_penerimaan' => 'date|after:awal_pendaftaran|after:akhir_pendaftaran|before:akhir_penerimaan',
            'akhir_penerimaan' => 'date|after:awal_pendaftaran|after:akhir_pendaftaran|after:awal_penerimaan',
            'biaya_pendidikan_per_semester' => 'integer',
            'penghasilan_orang_tua_maksimal' => 'integer',
            // 'ipk_minimal' => 'required'            
        ]);
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;
            $form_params = $request->except('_token', '_method');
            $form_params['beasiswa_id'] = $id;            
            $httpRequest = $client->put(Config::get('constants.api_base_url').'api/pembantu_direktur_3/beasiswa/update', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $form_params                
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $mahasiswa = $response->result->beasiswa;
            return redirect()->route('pembantu_direktur_3.beasiswa')->with('success', 'Beasiswa berhasil diupdate');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function destroyBeasiswa($id, Request $request)
    {        
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/pembantu_direktur_3/beasiswa/destroy', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'beasiswa_id' => $id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $mahasiswa = $response;
            return redirect()->route('pembantu_direktur_3.beasiswa')->with('success', 'Beasiswa berhasil dihapus');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function createKuotaBeasiswa($beasiswa_id)
    {        
        try {
            $client = new Client();             
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/beasiswa',[
                'query' => [
                    'beasiswa_id' => $beasiswa_id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $beasiswa = $response->result->beasiswa;
            $client = new Client();
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/program_studi/all');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listProgramStudi = $response->result->program_studi;
            return view('beasiswa.create_kuota', compact('beasiswa', 'listProgramStudi'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function storeKuotaBeasiswa(Request $request)
    {
        $this->validate($request, [
            'beasiswa_id' => 'required|integer',
            'program_studi_id' => 'required|integer',
            'angkatan' => 'required|integer',
            'kuota' => 'required|integer',
        ]);        
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;
            $form_params = $request->except('_token');            
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/pembantu_direktur_3/beasiswa/kuota/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $form_params
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $kuotaBeasiswa = $response->result->kuota_beasiswa;
            return redirect()->route('pembantu_direktur_3.beasiswa.kuota', $request->beasiswa_id)->with('success', 'Kuota beasiswa berhasil ditambahkan');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function editKuotaBeasiswa($beasiswa_id, $program_studi_id, $angkatan, Request $request)
    {              
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/pembantu_direktur_3/beasiswa/kuota/program_studi/angkatan', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'beasiswa_id' => $beasiswa_id,
                    'program_studi_id' => $program_studi_id,
                    'angkatan' => $angkatan
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $kuotaBeasiswa = $response->result->kuota_beasiswa;                        
            return view('pembantu_direktur_3.beasiswa_kuota_edit', compact('kuotaBeasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function updateKuotaBeasiswa(Request $request)
    {
        $this->validate($request, [
            'beasiswa_id' => 'required|integer',
            'program_studi_id' => 'required|integer',
            'angkatan' => 'required|integer',
            'kuota' => 'required|integer',
        ]);        
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;
            $form_params = $request->except('_token, _method');            
            $httpRequest = $client->put(Config::get('constants.api_base_url').'api/pembantu_direktur_3/beasiswa/kuota/update', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $form_params
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $kuotaBeasiswa = $response->result->kuota_beasiswa;
            return redirect()->route('pembantu_direktur_3.beasiswa.kuota', $request->beasiswa_id)->with('success', 'Kuota beasiswa berhasil diedit');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function destroyKuotaBeasiswa($beasiswa_id, $program_studi_id, $angkatan, Request $request)
    {            
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/pembantu_direktur_3/beasiswa/kuota/destroy', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'beasiswa_id' => $beasiswa_id,
                    'program_studi_id' => $program_studi_id,
                    'angkatan' => $angkatan
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            // $kuotaBeasiswa = $response->result->kuota_beasiswa;
            return redirect()->route('pembantu_direktur_3.beasiswa.kuota', $request->beasiswa_id)->with('success', 'Kuota beasiswa berhasil dihapus');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function getKuotaBeasiswa($id, Request $request)
    {
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/pembantu_direktur_3/beasiswa/kuota', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'beasiswa_id' => $id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $kuotaBeasiswa = $response->result->kuota_beasiswa;
            return view('pembantu_direktur_3.beasiswa_kuota', compact('kuotaBeasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function pendaftarBeasiswa($id, Request $request)
    {
    	try {
            $beasiswaId = $id;
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/pembantu_direktur_3/beasiswa/pendaftar', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                	'beasiswa_id' => $id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listPendaftarBeasiswa = $response->result->pendaftar_beasiswa;            
            $jumlahPendaftarBeasiswa = 0;
            foreach ($listPendaftarBeasiswa as $pendaftarBeasiswa) {                
                $jumlahPendaftarBeasiswa+=count($pendaftarBeasiswa->pendaftarBeasiswa);
            }
            return view('pembantu_direktur_3.beasiswa_pendaftar', compact('listPendaftarBeasiswa', 'jumlahPendaftarBeasiswa', 'beasiswaId'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function seleksiBeasiswa($id, Request $request)
    {        
    	try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/pembantu_direktur_3/beasiswa/seleksi', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                	'beasiswa_id' => $id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('pembantu_direktur_3.dashboard')->with('success', 'Pendaftar beasiswa berhasil diterima');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function penyelesaianBeasiswa($id, Request $request)
    {
    	try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/beasiswa/penyelesaian', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                	'beasiswa_id' => $id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $pendaftarBeasiswa = $response->result->pendaftar_beasiswa;            
            return redirect()->route('pembantu_direktur_3.dashboard')->with('success', 'Kuota beasiswa berhasil diedit');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }
}
