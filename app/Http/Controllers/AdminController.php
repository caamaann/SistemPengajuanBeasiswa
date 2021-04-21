<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Config;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('token.auth');
        $this->middleware('token.role:admin');

    }
    public function dashboard()
    {
    	return view('admin.dashboard');
    }

    public function indexMahasiswa(Request $request)
    {
        try {
            $client = new Client();
            $token = $request->session()->get('credential')->token;
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/admin/mahasiswa/all',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listMahasiswa = $response->result->mahasiswa;
            return view('admin.mahasiswa.index', compact('listMahasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function createMahasiswa(Request $request)
    {
        $client = new Client();
        $httpRequest = $client->get(Config::get('constants.api_base_url').'api/program_studi/all');
        $jsonResponse = $httpRequest->getBody();
        $response = json_decode($jsonResponse);
        $listProgramStudi = $response->result->program_studi;
        $token = $request->session()->get('credential')->token;                
        $httpRequest = $client->get(Config::get('constants.api_base_url').'api/admin/wali_kelas/all', [
            'headers' => [
                'Authorization' => 'bearer ' . $token,
            ],            
        ]);
        $jsonResponse = $httpRequest->getBody();
        $response = json_decode($jsonResponse);
        $listWaliKelas = $response->result->wali_kelas;
        return view('admin.mahasiswa.create', compact('listWaliKelas', 'listProgramStudi'));
    }

    public function storeMahasiswa(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|string|max:10',
            'nama' => 'required|string',
            'email' => 'required|email',
            'wali_kelas_id' => 'required|integer',
            'program_studi_id' => 'required|integer',
            'semester' => 'required|integer|gt:0|lt:8',
            'angkatan' => 'required|integer|gt:0',
            'ipk' => 'required|gt:0|lt:4',
        ]);
        
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/admin/mahasiswa/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'nim' => $request->nim,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'wali_kelas_id' => $request->wali_kelas_id,
                    'program_studi_id' => $request->program_studi_id,
                    'semester' => $request->semester,
                    'angkatan' => $request->angkatan,
                    'ipk' => $request->ipk,
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $mahasiswa = $response->result->mahasiswa;
            return redirect()->route('admin.mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }       
        
    }

    public function editMahasiswa($id, Request $request)
    {
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/program_studi/all');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listProgramStudi = $response->result->program_studi;
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/admin/wali_kelas/all', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();        
            $response = json_decode($jsonResponse);
            $listWaliKelas = $response->result->wali_kelas;
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/admin/mahasiswa/',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $mahasiswa = $response->result->mahasiswa;
            return view('admin.mahasiswa.edit', compact('mahasiswa', 'listProgramStudi', 'listWaliKelas'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function updateMahasiswa($id, Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|string|max:10',
            'nama' => 'required|string',
            'email' => 'required|email',
            'wali_kelas_id' => 'required|integer',
            'program_studi_id' => 'required|integer',
            'semester' => 'required|integer|gt:0|lt:8',
            'angkatan' => 'required|integer|gt:0',
            'ipk' => 'required|gt:0|lt:4',
        ]);
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;
            $form_params = $request->except('_token', '_method');
            $form_params['id'] = $id;
            $httpRequest = $client->put(Config::get('constants.api_base_url').'api/admin/mahasiswa/update', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => $form_params
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            return redirect()->route('admin.mahasiswa')->with('success', 'Mahasiswa berhasil diupdate');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function destroyMahasiswa($id, Request $request)
    {
        try {
            $client = new Client();             
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/admin/mahasiswa/destroy', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            // $waliKelas = $response->result->wali_kelas;
            return redirect()->route('admin.mahasiswa')->with('success', 'Mahasiswa berhasil dihapus');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }    

    public function indexWaliKelas(Request $request)
    {
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/admin/wali_kelas/all',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listWaliKelas = $response->result->wali_kelas;
            return view('admin.wali_kelas.index', compact('listWaliKelas'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function createWaliKelas()
    {
        $client = new Client();
        $httpRequest = $client->get(Config::get('constants.api_base_url').'api/jurusan/all');
        $jsonResponse = $httpRequest->getBody();
        $response = json_decode($jsonResponse);
        $listJurusan = $response->result->jurusan;        
        return view('admin.wali_kelas.create', compact('listJurusan'));
    }

    public function storeWaliKelas(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string|max:20',
            'nama' => 'required|string',
            'jurusan_id' => 'required|integer',
        ]);
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/admin/wali_kelas/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [                    
                    'nip' => $request->nip,
                    'nama' => $request->nama,
                    'jurusan_id' => $request->jurusan_id,                    
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $waliKelas = $response->result->wali_kelas;
            return redirect()->route('admin.wali_kelas')->with('success', 'Wali kelas berhasil ditambahkan');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function editWaliKelas($id, Request $request)
    {
        try {
            $client = new Client(); 
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/jurusan/all');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listJurusan = $response->result->jurusan;                      
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/admin/wali_kelas/',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $waliKelas = $response->result->wali_kelas;
            return view('admin.wali_kelas.edit', compact('waliKelas', 'listJurusan'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function updateWaliKelas($id, Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string|max:20',
            'nama' => 'required|string',
            'jurusan_id' => 'required|integer',            
        ]);
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;
            $form_params = $request->except('_token', '_method');
            $form_params['id'] = $id;            
            $httpRequest = $client->put(Config::get('constants.api_base_url').'api/admin/wali_kelas/update', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $form_params                
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('admin.wali_kelas')->with('success', 'Wali Kelas berhasil diupdate');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function destroyWaliKelas($id, Request $request)
    {
        try {
            $client = new Client();             
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/admin/wali_kelas/destroy', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            // $waliKelas = $response->result->wali_kelas;
            return redirect()->route('admin.wali_kelas')->with('success', 'Wali kelas berhasil dihapus');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }    

    public function indexKetuaProgramStudi(Request $request)
    {
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/admin/ketua_program_studi/all',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listKetuaProgramStudi = $response->result->ketua_program_studi;
            return view('admin.ketua_program_studi.index', compact('listKetuaProgramStudi'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function createKetuaProgramStudi()
    {
        $client = new Client();
        $httpRequest = $client->get(Config::get('constants.api_base_url').'api/program_studi/all');
        $jsonResponse = $httpRequest->getBody();
        $response = json_decode($jsonResponse);
        $listProgramStudi = $response->result->program_studi;               
        return view('admin.ketua_program_studi.create', compact('listProgramStudi'));
    }

    public function storeKetuaProgramStudi(Request $request)
    {
        $this->validate($request, [            
            'nip' => 'required|string|max:20',
            'nama' => 'required|string',
            'program_studi_id' => 'required|integer',
        ]);
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/admin/ketua_program_studi/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [                    
                    'nip' => $request->nip,                    
                    'nama' => $request->nama,                    
                    'program_studi_id' => $request->program_studi_id,                    
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $ketuaProgramStudi = $response->result->ketua_program_studi;
            return redirect()->route('admin.ketua_program_studi')->with('success', 'Ketua program studi berhasil ditambahkan');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
        
    }

    public function editKetuaProgramStudi($id, Request $request)
    {
        try {
            $client = new Client(); 
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/program_studi/all');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listProgramStudi = $response->result->program_studi;                      
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/admin/ketua_program_studi/',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $ketuaProgramStudi = $response->result->ketua_program_studi;
            return view('admin.ketua_program_studi.edit', compact('ketuaProgramStudi', 'listProgramStudi'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function updateKetuaProgramStudi($id, Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string|max:20',
            'nama' => 'required|string',
            'program_studi_id' => 'required|integer',            
        ]);
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;
            $form_params = $request->except('_token', '_method');
            $form_params['id'] = $id;            
            $httpRequest = $client->put(Config::get('constants.api_base_url').'api/admin/ketua_program_studi/update', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $form_params                
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('admin.ketua_program_studi')->with('success', 'Ketua program studi berhasil diupdate');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function destroyKetuaProgramStudi($id, Request $request)
    {
        try {
            $client = new Client();             
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/admin/ketua_program_studi/destroy', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            // $waliKelas = $response->result->wali_kelas;
            return redirect()->route('admin.ketua_program_studi')->with('success', 'Ketua program studi berhasil dihapus');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }


    public function indexKetuaJurusan(Request $request)
    {
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/admin/ketua_jurusan/all',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listKetuaJurusan = $response->result->ketua_jurusan;
            return view('admin.ketua_jurusan.index', compact('listKetuaJurusan'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function createKetuaJurusan()
    {
        $client = new Client();
        $httpRequest = $client->get(Config::get('constants.api_base_url').'api/jurusan/all');
        $jsonResponse = $httpRequest->getBody();
        $response = json_decode($jsonResponse);
        $listJurusan = $response->result->jurusan;                      
        return view('admin.ketua_jurusan.create', compact('listJurusan'));
    }

    public function storeKetuaJurusan(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string|max:20',
            'nama' => 'required|string',
            'jurusan_id' => 'required|integer',
        ]);
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/admin/ketua_jurusan/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'nip' => $request->nip,
                    'nama' => $request->nama,
                    'jurusan_id' => $request->jurusan_id,                    
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $ketuaJurusan = $response->result->ketua_jurusan;
            return redirect()->route('admin.ketua_jurusan')->with('success', 'Ketua jurusan berhasil ditambahkan');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }       
    }

    public function editKetuaJurusan($id, Request $request)
    {
        try {
            $client = new Client(); 
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/jurusan/all');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listJurusan = $response->result->jurusan;                      
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/admin/ketua_jurusan/',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $ketuaJurusan = $response->result->ketua_jurusan;
            return view('admin.ketua_jurusan.edit', compact('ketuaJurusan', 'listJurusan'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function updateKetuaJurusan($id, Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string|max:20',
            'nama' => 'required|string',
            'jurusan_id' => 'required|integer',            
        ]);
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;
            $form_params = $request->except('_token', '_method');
            $form_params['id'] = $id;            
            $httpRequest = $client->put(Config::get('constants.api_base_url').'api/admin/ketua_jurusan/update', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $form_params                
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('admin.ketua_jurusan')->with('success', 'Ketua jurusan berhasil diupdate');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function destroyKetuaJurusan($id, Request $request)
    {
        try {
            $client = new Client();             
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/admin/ketua_jurusan/destroy', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            // $waliKelas = $response->result->wali_kelas;
            return redirect()->route('admin.ketua_jurusan')->with('success', 'Ketua jurusan berhasil dihapus');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }


    public function indexPembantuDirektur3(Request $request)
    {
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/admin/pembantu_direktur_3/all',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listPembantuDirektur3 = $response->result->pembantu_direktur_3;
            return view('admin.pembantu_direktur_3.index', compact('listPembantuDirektur3'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function createPembantuDirektur3()
    {        
        return view('admin.pembantu_direktur_3.create');
    }

    public function storePembantuDirektur3(Request $request)
    {
        $this->validate($request, [            
            'nip' => 'required|string|max:20',
            'nama' => 'required|string',
        ]);
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/admin/pembantu_direktur_3/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [                    
                    'nip' => $request->nip,
                    'nama' => $request->nama,
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $pd3 = $response->result->pembantu_direktur_3;
            return redirect()->route('admin.pembantu_direktur_3')->with('success', 'Pembantu direktur 3 berhasil ditambahkan');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function editPembantuDirektur3($id, Request $request)
    {
        try {
            $client = new Client(); 
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/jurusan/all');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listJurusan = $response->result->jurusan;                      
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/admin/pembantu_direktur_3/',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $pembantuDirektur3 = $response->result->pembantu_direktur_3;
            return view('admin.pembantu_direktur_3.edit', compact('pembantuDirektur3', 'listJurusan'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function updatePembantuDirektur3($id, Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string|max:20',
            'nama' => 'required|string',            
        ]);
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;
            $form_params = $request->except('_token', '_method');
            $form_params['id'] = $id;            
            $httpRequest = $client->put(Config::get('constants.api_base_url').'api/admin/pembantu_direktur_3/update', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $form_params                
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('admin.pembantu_direktur_3')->with('success', 'Pembantu direktur 3 berhasil diupdate');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function destroyPembantuDirektur3($id, Request $request)
    {
        try {
            $client = new Client();             
            $token = $request->session()->get('credential')->token;                
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/admin/pembantu_direktur_3/destroy', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            // $waliKelas = $response->result->wali_kelas;
            return redirect()->route('admin.pembantu_direktur_3')->with('success', 'Pembantu direktur 3 berhasil dihapus');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }


}
