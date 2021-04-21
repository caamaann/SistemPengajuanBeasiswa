<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Config;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('token.auth');
        $this->middleware('token.role:mahasiswa');

    }

    public function dashboard()
    {
    	return view('mahasiswa.dashboard');
    }

    public function beasiswa(Request $request)
    {
    	try {
            $client = new Client();             
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/beasiswa/all');
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listBeasiswa = $response->result->beasiswa;            
            return view('mahasiswa.beasiswa_index', compact('listBeasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function showBeasiswa($id, Request $request)
    {
        try {
            $client = new Client();             
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/beasiswa/', [
                'query' => [
                    'beasiswa_id' => $id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $beasiswa = $response->result->beasiswa;            
            return view('mahasiswa.beasiswa_show', compact('beasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function applyBeasiswa($beasiswa_id, Request $request)
    {
        try {
            $client = new Client();
            $token = $request->session()->get('credential')->token;
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/beasiswa/pendaftaran',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'beasiswa_id' => $beasiswa_id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            if ($response->status == 201) {
                return back()->with('fail', $response->message);
            }else if ($response->status == 200){
                return redirect()->route('mahasiswa.dashboard')->with('success', 'Berhasil Mendaftar Beasiswa');
            }
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }

    public function profile(Request $request)
    {
        try {
            $client = new Client();
            $token = $request->session()->get('credential')->token;
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/user/profile',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $mahasiswa = $response->result->user->profile;
            $kelengkapanDataMahasiswa = (!is_null($mahasiswa->tempat_lahir) && !is_null($mahasiswa->tanggal_lahir) && !is_null($mahasiswa->gender) && !is_null($mahasiswa->nama_bank) && !is_null($mahasiswa->nomor_rekening) && !is_null($mahasiswa->alamat) && !is_null($mahasiswa->kota) && !is_null($mahasiswa->kode_pos) && !is_null($mahasiswa->nomor_hp));
            return view('mahasiswa.profile', compact('mahasiswa', 'kelengkapanDataMahasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
        
    }

    public function edit(Request $request)
    {
        try {
            $client = new Client();
            $token = $request->session()->get('credential')->token;
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/user/profile',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $mahasiswa = $response->result->user->profile;
            return view('mahasiswa.edit', compact('mahasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }           
    }

    public function update(Request $request)
    {        
        $this->validate($request, [                
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date|before:today',
            'gender' => 'required|string|max:2',            
            'nama_bank' => 'required|string',
            'nomor_rekening' => 'required|string',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'kode_pos' => 'required|string',
            'nomor_hp' => 'required|string',            
        ]);
        try {
            $formParams = $request->except('_token', '_method');
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->put(Config::get('constants.api_base_url').'api/mahasiswa/update', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $formParams
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $user = $response->result->mahasiswa;
            return redirect()->route('mahasiswa.profile')->with('success', 'Mahasiswa berhasil diedit');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
        // try {
        //     $client = new Client(); 
        //     $token = $request->session()->get('credential')->token;
        //     $form_params = $request->except('_token', '_method');
        //     echo json_encode($form_params);
        //     $fileRealPath = $request->sertifikat_ppkk->getPathname();            

        //     $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/update', [
        //         'headers' => [
        //             'Authorization' => 'bearer ' . $token,
        //         ],                
        //         'multipart' => [
        //             [
        //                 'name' => 'sertifikat_ppkk',
        //                 'contents' => fopen( $fileRealPath, 'r' ),
        //             ],
        //             [
        //                 'name' => 'nama',
        //                 'contents' => $request->nama,
        //             ],
        //             [
        //                 'name' => 'gender',
        //                 'contents' => $request->gender,
        //             ],
        //             [
        //                 'name' => 'tempat_lahir',
        //                 'contents' => $request->tempat_lahir,
        //             ],
        //             [
        //                 'name' => 'tanggal_lahir',
        //                 'contents' => $request->tanggal_lahir,
        //             ],
        //             [
        //                 'name' => 'alamat',
        //                 'contents' => $request->alamat,
        //             ],
        //             [
        //                 'name' => 'kota',
        //                 'contents' => $request->kota,
        //             ],
        //             [
        //                 'name' => 'kode_pos',
        //                 'contents' => $request->kode_pos,
        //             ],
        //             [
        //                 'name' => 'nomor_hp',
        //                 'contents' => $request->nomor_hp,
        //             ],
        //             [
        //                 'name' => 'email',
        //                 'contents' => $request->email,
        //             ],
        //             [
        //                 'name' => 'nama_bank',
        //                 'contents' => $request->nama_bank,
        //             ],
        //             [
        //                 'name' => 'nomor_rekening',
        //                 'contents' => $request->nomor_rekening,
        //             ],                    
        //         ]
        //     ]);

        //     $jsonResponse = $httpRequest->getBody();
        //     $response = json_decode($jsonResponse);            
        //     $user = $response->result->user;
        //     return redirect()->route('mahasiswa.profile')->with('success', 'Profil berhasil diupdate');
        // } catch (GuzzleHttp\Exception\ClientException $e) {
        //     $response = $e->getResponse();
        //     $responseBodyAsString = $response->getBody()->getContents();
        //     echo $responseBodyAsString;
        // }
    }

    public function getOrangTuaMahasiswa(Request $request)
    {
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/mahasiswa/orangtua', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],                
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $orangTua = null;
            if (isset($response->result)) {
                $orangTua = $response->result->orang_tua;
            }
            return view('mahasiswa.orangtua', compact('orangTua'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function createOrangTuaMahasiswa(Request $request)
    {
        return view('mahasiswa.orangtua_create');
    }

    public function storeOrangTuaMahasiswa(Request $request)
    {
        $this->validate($request, [                
            'nama_ayah' => 'required|string',
            'tempat_lahir_ayah' => 'required|string',
            'tanggal_lahir_ayah' => 'required|date|before:today',
            'alamat_ayah' => 'required|string',            
            'nomor_hp_ayah' => 'required|string|max:13',
            'pekerjaan_ayah' => 'required|string',
            'penghasilan_ayah' => 'required|integer',
            'pekerjaan_sambilan_ayah' => 'required|string',
            'penghasilan_sambilan_ayah' => 'required|integer',
            'nama_ibu' => 'required|string',
            'tempat_lahir_ibu' => 'required|string',
            'tanggal_lahir_ibu' => 'required|date|before:today',
            'alamat_ibu' => 'required|string',            
            'nomor_hp_ibu' => 'required|string|max:13',
            'pekerjaan_ibu' => 'required|string',
            'penghasilan_ibu' => 'required|integer',
            'pekerjaan_sambilan_ibu' => 'required|string',
            'penghasilan_sambilan_ibu' => 'required|integer',
        ]);
        try {
            $formParams = $request->except('_token');
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/orangtua/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $formParams
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $orangtua = $response->result->orang_tua;
            return redirect()->route('mahasiswa.orang_tua')->with('success', 'Orang Tua berhasil ditambahkan');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function editOrangTuaMahasiswa(Request $request)
    {
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/mahasiswa/orangtua', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],                
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            $orangTua = $response->result->orang_tua;            
            return view('mahasiswa.orangtua_edit', compact('orangTua'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function updateOrangTuaMahasiswa(Request $request)
    {
        $this->validate($request, [                
            'nama_ayah' => 'required|string',
            'tempat_lahir_ayah' => 'required|string',
            'tanggal_lahir_ayah' => 'required|date|before:today',
            'alamat_ayah' => 'required|string',            
            'nomor_hp_ayah' => 'required|string|max:13',
            'pekerjaan_ayah' => 'required|string',
            'penghasilan_ayah' => 'required|integer',
            'pekerjaan_sambilan_ayah' => 'required|string',
            'penghasilan_sambilan_ayah' => 'required|integer',
            'nama_ibu' => 'required|string',
            'tempat_lahir_ibu' => 'required|string',
            'tanggal_lahir_ibu' => 'required|date|before:today',
            'alamat_ibu' => 'required|string',            
            'nomor_hp_ibu' => 'required|string|max:13',
            'pekerjaan_ibu' => 'required|string',
            'penghasilan_ibu' => 'required|integer',
            'pekerjaan_sambilan_ibu' => 'required|string',
            'penghasilan_sambilan_ibu' => 'required|integer',
        ]);
        try {
            $formParams = $request->except('_token', '_method');
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->put(Config::get('constants.api_base_url').'api/mahasiswa/orangtua/update', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $formParams
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $orangtua = $response->result->orang_tua;
            return redirect()->route('mahasiswa.orang_tua')->with('success', 'Orang Tua berhasil diedit');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function getAllSaudaraMahasiswa(Request $request)
    {
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/mahasiswa/saudara/all', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],                
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            $listSaudaraMahasiswa = $response->result->saudara;            
            return view('mahasiswa.saudara', compact('listSaudaraMahasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function createSaudaraMahasiswa(Request $request)
    {
        return view('mahasiswa.saudara_create');
    }

    public function storeSaudaraMahasiswa(Request $request)
    {
        $this->validate($request, [                            
            'nama' => 'string',
            'usia' => 'integer|gt:0',
            'status_pernikahan' => 'string|in:Menikah,Belum menikah',
            'status_saudara' => 'string|in:Kakak,Adik',
            'status_pekerjaan' => 'string|in:Bekerja,Belum bekerja',
        ]);
        try {
            $formParams = $request->except('_token');            
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/saudara/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $formParams
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $saudara = $response->result->saudara;
            return redirect()->route('mahasiswa.saudara')->with('success', 'Saudara berhasil ditambahkan');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function editSaudaraMahasiswa($id, Request $request)
    {
        try {
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/mahasiswa/saudara', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'saudara_id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            $saudaraMahasiswa = $response->result->saudara;            
            return view('mahasiswa.saudara_edit', compact('saudaraMahasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function updateSaudaraMahasiswa($id, Request $request)
    {
        $this->validate($request, [                            
            'nama' => 'string',
            'usia' => 'integer|gt:0',
            'status_pernikahan' => 'string|in:Menikah,Belum menikah',
            'status_saudara' => 'string|in:Kakak,Adik',
            'status_pekerjaan' => 'string|in:Bekerja,Belum bekerja',
        ]);
        try {
            $formParams = $request->except('_token', '_method');
            $formParams['saudara_id'] = $id;
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->put(Config::get('constants.api_base_url').'api/mahasiswa/saudara/update', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => $formParams
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $saudara = $response->result->saudara;
            return redirect()->route('mahasiswa.saudara')->with('success', 'Saudara berhasil diedit');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function destroySaudaraMahasiswa($id, Request $request)
    {        
        try {            
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;            
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/saudara/destroy', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'form_params' => [
                    'saudara_id' => $id
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('mahasiswa.saudara')->with('success', 'Saudara berhasil dihapus');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function getSertifikatWajib(Request $request)
    {
        try {
            $client = new Client();
            $token = $request->session()->get('credential')->token;
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/user/profile',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $mahasiswa = $response->result->user->profile;            
            return view('mahasiswa.sertifikat_wajib', compact('mahasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }

    public function createSertifikatWajib()
    {
        return view('mahasiswa.sertifikat_wajib_create');
    }

    public function storeSertifikatWajib(Request $request)
    {
        $this->validate($request, [                
            'sertifikat_ppkk' => 'image',
            'sertifikat_bn' => 'image',
            'sertifikat_metagama' => 'image',
            'sertifikat_butterfly' => 'image',
            'sertifikat_esq' => 'image',
        ]);
        try {
            $multipart=array();            
            if ($request->hasFile('sertifikat_ppkk')) {            
                array_push($multipart, [
                    'name' => 'sertifikat_ppkk',
                    'contents' => fopen($request->sertifikat_ppkk->getPathname(), 'r' ),
                ]);                
            }
            if ($request->hasFile('sertifikat_bn')) {
                array_push($multipart,[
                    'name' => 'sertifikat_bn',
                    'contents' => fopen($request->sertifikat_bn->getPathname(), 'r' ),
                ]);                
            }            

            if ($request->hasFile('sertifikat_metagama')) {
                array_push($multipart, [
                    'name' => 'sertifikat_metagama',
                    'contents' => fopen($request->sertifikat_metagama->getPathname(), 'r' ),
                ]);
            }

            if ($request->hasFile('sertifikat_esq')) {
                array_push($multipart,[
                    'name' => 'sertifikat_esq',
                    'contents' => fopen($request->sertifikat_esq->getPathname(), 'r' ),
                ]);
            }

            if ($request->hasFile('sertifikat_butterfly')) {
                array_push($multipart, [
                    'name' => 'sertifikat_butterfly',
                    'contents' => fopen($request->sertifikat_butterfly->getPathname(), 'r' ),
                ]);
            }
            
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                        
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/sertifikat/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],                
                'multipart' => $multipart,
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('mahasiswa.sertifikat.wajib')->with('success', 'Sertifikat wajib berhasil diupload');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function getBerkasWajib(Request $request)
    {
        try {
            $client = new Client();
            $token = $request->session()->get('credential')->token;
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/user/profile',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $mahasiswa = $response->result->user->profile;            
            return view('mahasiswa.berkas_wajib', compact('mahasiswa'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }

    public function createBerkasWajib()
    {
        return view('mahasiswa.berkas_wajib_create');
    }

    public function storeBerkasWajib(Request $request)
    {
        $this->validate($request, [                
            'file_transkrip_nilai' => 'image',
            'file_kk' => 'image',
            'file_ktm' => 'image',            
        ]);
        try {
            $multipart=array();            
            if ($request->hasFile('file_transkrip_nilai')) {            
                array_push($multipart, [
                    'name' => 'file_transkrip_nilai',
                    'contents' => fopen($request->file_transkrip_nilai->getPathname(), 'r' ),
                ]);                
            }
            if ($request->hasFile('file_kk')) {
                array_push($multipart,[
                    'name' => 'file_kk',
                    'contents' => fopen($request->file_kk->getPathname(), 'r' ),
                ]);                
            }            

            if ($request->hasFile('file_ktm')) {
                array_push($multipart, [
                    'name' => 'file_ktm',
                    'contents' => fopen($request->file_ktm->getPathname(), 'r' ),
                ]);
            }            
            
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                        
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/berkas/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],                
                'multipart' => $multipart,
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('mahasiswa.berkas.wajib')->with('success', 'Berkas berhasil diupload');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }
    }

    public function getSertifikatPrestasi(Request $request)
    {
        try {
            $client = new Client();
            $token = $request->session()->get('credential')->token;
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/mahasiswa/sertifikat/prestasi/all',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listSertifikat = $response->result->sertifikat;            
            return view('mahasiswa.sertifikat_prestasi', compact('listSertifikat'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }

    public function createSertifikatPrestasi()
    {        
        return view('mahasiswa.sertifikat_prestasi_create');        
    }

    public function storeSertifikatPrestasi(Request $request)
    {        
        $this->validate($request, [                
            'file_sertifikat' => 'required|image',
            'tingkat_prestasi' => 'required|string|in:Internasional,Nasional,Provinsi,Kota',
        ]);
        try {
            $multipart=array();            
            if ($request->hasFile('file_sertifikat')) {            
                array_push($multipart, [
                    'name' => 'file_sertifikat',
                    'contents' => fopen($request->file_sertifikat->getPathname(), 'r' ),
                ]);                
            }

            array_push($multipart, [
                'name' => 'tingkat_prestasi',
                'contents' => $request->tingkat_prestasi,
            ]);
            
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                        
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/sertifikat/prestasi/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],                
                'multipart' => $multipart,
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('mahasiswa.sertifikat.prestasi')->with('success', 'Berkas berhasil diupload');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }

    public function editSertifikatPrestasi($id, Request $request)
    {
        try {
            $client = new Client();
            $token = $request->session()->get('credential')->token;
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/mahasiswa/sertifikat/prestasi/',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $sertifikat = $response->result->sertifikat;
            return view('mahasiswa.sertifikat_prestasi_edit', compact('sertifikat'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }

    public function updateSertifikatPrestasi($id, Request $request)
    {        
        $this->validate($request, [                
            'file_sertifikat' => 'required|image',
            'tingkat_prestasi' => 'required|string|in:Internasional,Nasional,Provinsi,Kota',
        ]);
        try {
            $multipart=array();            
            if ($request->hasFile('file_sertifikat')) {            
                array_push($multipart, [
                    'name' => 'file_sertifikat',
                    'contents' => fopen($request->file_sertifikat->getPathname(), 'r' ),
                ]);                
            }

            array_push($multipart, [
                'name' => 'tingkat_prestasi',
                'contents' => $request->tingkat_prestasi,
            ]);

            array_push($multipart, [
                'name' => 'id',
                'contents' => $id,
            ]);
            
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                        
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/sertifikat/prestasi/update', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],                
                'multipart' => $multipart,
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('mahasiswa.sertifikat.prestasi')->with('success', 'Berkas berhasil diupload');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }

    public function destroySertifikatPrestasi($id, Request $request)
    {                
        try {            
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                        
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/sertifikat/prestasi/destroy', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],                
                'form_params' => [
                    'id' => $id,
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('mahasiswa.sertifikat.prestasi')->with('success', 'Berkas berhasil dihapus');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }


    public function getSertifikatOrganisasi(Request $request)
    {
        try {
            $client = new Client();
            $token = $request->session()->get('credential')->token;
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/mahasiswa/sertifikat/organisasi/all',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $listSertifikat = $response->result->sertifikat;            
            return view('mahasiswa.sertifikat_organisasi', compact('listSertifikat'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }

    public function createSertifikatOrganisasi()
    {        
        return view('mahasiswa.sertifikat_organisasi_create');        
    }

    public function storeSertifikatOrganisasi(Request $request)
    {        
        $this->validate($request, [                
            'file_sertifikat' => 'required|image',
            'jenis' => 'required|string|in:Pengurus Organisasi,Kepanitiaan Program Kerja Kemahasiswaan',
        ]);
        try {
            $multipart=array();            
            if ($request->hasFile('file_sertifikat')) {            
                array_push($multipart, [
                    'name' => 'file_sertifikat',
                    'contents' => fopen($request->file_sertifikat->getPathname(), 'r' ),
                ]);                
            }

            array_push($multipart, [
                'name' => 'jenis',
                'contents' => $request->jenis,
            ]);
            
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                        
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/sertifikat/organisasi/store', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],                
                'multipart' => $multipart,
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('mahasiswa.sertifikat.organisasi')->with('success', 'Berkas berhasil diupload');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }

    public function editSertifikatOrganisasi($id, Request $request)
    {
        try {
            $client = new Client();
            $token = $request->session()->get('credential')->token;
            $httpRequest = $client->get(Config::get('constants.api_base_url').'api/mahasiswa/sertifikat/organisasi/',[
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],
                'query' => [
                    'id' => $id,
                ]
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);
            $sertifikat = $response->result->sertifikat;
            return view('mahasiswa.sertifikat_organisasi_edit', compact('sertifikat'));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }

    public function updateSertifikatOrganisasi($id, Request $request)
    {        
        $this->validate($request, [                
            'file_sertifikat' => 'required|image',
            'jenis' => 'required|string|in:Pengurus Organisasi,Kepanitiaan Program Kerja Kemahasiswaan',
        ]);
        try {
            $multipart=array();            
            if ($request->hasFile('file_sertifikat')) {            
                array_push($multipart, [
                    'name' => 'file_sertifikat',
                    'contents' => fopen($request->file_sertifikat->getPathname(), 'r' ),
                ]);                
            }

            array_push($multipart, [
                'name' => 'jenis',
                'contents' => $request->jenis,
            ]);

            array_push($multipart, [
                'name' => 'id',
                'contents' => $id,
            ]);
            
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                        
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/sertifikat/organisasi/update', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],                
                'multipart' => $multipart,
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('mahasiswa.sertifikat.organisasi')->with('success', 'Berkas berhasil diupload');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }

    public function destroySertifikatOrganisasi($id, Request $request)
    {                
        try {            
            $client = new Client(); 
            $token = $request->session()->get('credential')->token;                        
            $httpRequest = $client->post(Config::get('constants.api_base_url').'api/mahasiswa/sertifikat/organisasi/destroy', [
                'headers' => [
                    'Authorization' => 'bearer ' . $token,
                ],                
                'form_params' => [
                    'id' => $id,
                ],
            ]);
            $jsonResponse = $httpRequest->getBody();
            $response = json_decode($jsonResponse);            
            return redirect()->route('mahasiswa.sertifikat.organisasi')->with('success', 'Berkas berhasil dihapus');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            echo $responseBodyAsString;
        }        
    }


}

