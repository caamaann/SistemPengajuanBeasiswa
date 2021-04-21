<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
	return redirect()->route('home');
});
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('login', 'AuthenticationController@loginForm')->name('auth.login_form');
Route::post('login_submit', 'AuthenticationController@login')->name('auth.login');
Route::post('logout', 'AuthenticationController@logout')->name('auth.logout');

Route::prefix('admin')->group(function(){	
	Route::prefix('mahasiswa')->group(function(){
		Route::get('/create', 'AdminController@createMahasiswa')->name('admin.mahasiswa.create');
		Route::post('/store', 'AdminController@storeMahasiswa')->name('admin.mahasiswa.store');
		Route::get('/edit/{id}', 'AdminController@editMahasiswa')->name('admin.mahasiswa.edit');
		Route::patch('/update/{id}', 'AdminController@updateMahasiswa')->name('admin.mahasiswa.update');
		Route::post('/destroy/{id}', 'AdminController@destroyMahasiswa')->name('admin.mahasiswa.destroy');
		Route::get('/', 'AdminController@indexMahasiswa')->name('admin.mahasiswa');
	});

	Route::prefix('wali_kelas')->group(function(){
		Route::get('/create', 'AdminController@createWaliKelas')->name('admin.wali_kelas.create');
		Route::post('/store', 'AdminController@storeWaliKelas')->name('admin.wali_kelas.store');
		Route::get('/edit/{id}', 'AdminController@editWaliKelas')->name('admin.wali_kelas.edit');
		Route::patch('/update/{id}', 'AdminController@updateWaliKelas')->name('admin.wali_kelas.update');
		Route::post('/destroy/{id}', 'AdminController@destroyWaliKelas')->name('admin.wali_kelas.destroy');
		Route::get('/', 'AdminController@indexWaliKelas')->name('admin.wali_kelas');
	});
	Route::prefix('ketua_program_studi')->group(function(){
		Route::get('/create', 'AdminController@createKetuaProgramStudi')->name('admin.ketua_program_studi.create');
		Route::post('/store', 'AdminController@storeKetuaProgramStudi')->name('admin.ketua_program_studi.store');
		Route::get('/edit/{id}', 'AdminController@editKetuaProgramStudi')->name('admin.ketua_program_studi.edit');
		Route::patch('/update/{id}', 'AdminController@updateKetuaProgramStudi')->name('admin.ketua_program_studi.update');
		Route::post('/destroy/{id}', 'AdminController@destroyKetuaProgramStudi')->name('admin.ketua_program_studi.destroy');
		Route::get('/', 'AdminController@indexKetuaProgramStudi')->name('admin.ketua_program_studi');
	});
	Route::prefix('ketua_jurusan')->group(function(){
		Route::get('/create', 'AdminController@createKetuaJurusan')->name('admin.ketua_jurusan.create');
		Route::post('/store', 'AdminController@storeKetuaJurusan')->name('admin.ketua_jurusan.store');
		Route::get('/edit/{id}', 'AdminController@editKetuaJurusan')->name('admin.ketua_jurusan.edit');
		Route::patch('/update/{id}', 'AdminController@updateKetuaJurusan')->name('admin.ketua_jurusan.update');
		Route::post('/destroy/{id}', 'AdminController@destroyKetuaJurusan')->name('admin.ketua_jurusan.destroy');
		Route::get('/', 'AdminController@indexKetuaJurusan')->name('admin.ketua_jurusan');
	});
	Route::prefix('pembantu_direktur_3')->group(function(){
		Route::get('/create', 'AdminController@createPembantuDirektur3')->name('admin.pembantu_direktur_3.create');
		Route::post('/store', 'AdminController@storePembantuDirektur3')->name('admin.pembantu_direktur_3.store');
		Route::get('/edit/{id}', 'AdminController@editPembantuDirektur3')->name('admin.pembantu_direktur_3.edit');
		Route::patch('/update/{id}', 'AdminController@updatePembantuDirektur3')->name('admin.pembantu_direktur_3.update');
		Route::post('/destroy/{id}', 'AdminController@destroyPembantuDirektur3')->name('admin.pembantu_direktur_3.destroy');		
		Route::get('/', 'AdminController@indexPembantuDirektur3')->name('admin.pembantu_direktur_3');
	});	
	Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
});

Route::prefix('pembantu_direktur_3')->group(function(){
	Route::get('/', 'PembantuDirektur3Controller@dashboard')->name('pembantu_direktur_3.dashboard');

	Route::prefix('beasiswa')->group(function(){
		Route::get('/', 'PembantuDirektur3Controller@beasiswa')->name('pembantu_direktur_3.beasiswa');
		Route::get('/create', 'PembantuDirektur3Controller@createBeasiswa')->name('pembantu_direktur_3.beasiswa.create');
		Route::post('/store', 'PembantuDirektur3Controller@storeBeasiswa')->name('pembantu_direktur_3.beasiswa.store');
		Route::get('/edit/{id}', 'PembantuDirektur3Controller@editBeasiswa')->name('pembantu_direktur_3.beasiswa.edit');
		Route::patch('/update/{id}', 'PembantuDirektur3Controller@updateBeasiswa')->name('pembantu_direktur_3.beasiswa.update');
		Route::post('/destroy/{id}', 'PembantuDirektur3Controller@destroyBeasiswa')->name('pembantu_direktur_3.beasiswa.destroy');

		Route::get('/pendaftar/{id}', 'PembantuDirektur3Controller@pendaftarBeasiswa')->name('pembantu_direktur_3.beasiswa.pendaftar');
		Route::post('/seleksi/{id}', 'PembantuDirektur3Controller@seleksiBeasiswa')->name('pembantu_direktur_3.beasiswa.seleksi');
		// Route::post('/penyelesaian/{id}', 'PembantuDirektur3Controller@penyelesaianBeasiswa')->name('pembantu_direktur_3.beasiswa.penyelesaian');

		Route::prefix('kuota')->group(function(){
			Route::get('/{id}', 'PembantuDirektur3Controller@getKuotaBeasiswa')->name('pembantu_direktur_3.beasiswa.kuota');
			Route::get('/create/{id}', 'PembantuDirektur3Controller@createKuotaBeasiswa')->name('pembantu_direktur_3.beasiswa.kuota.create');
			Route::post('/store', 'PembantuDirektur3Controller@storeKuotaBeasiswa')->name('pembantu_direktur_3.beasiswa.kuota.store');
			Route::get('/edit/{beasiswa_id}/{program_studi_id}/{angkatan}', 'PembantuDirektur3Controller@editKuotaBeasiswa')->name('pembantu_direktur_3.beasiswa.kuota.edit');
			Route::patch('/update', 'PembantuDirektur3Controller@updateKuotaBeasiswa')->name('beasiswa.kuota.update');
			Route::post('/destroy/{beasiswa_id}/{program_studi_id}/{angkatan}', 'PembantuDirektur3Controller@destroyKuotaBeasiswa')->name('pembantu_direktur_3.beasiswa.kuota.destroy');
		});
	});

});

Route::prefix('wali_kelas')->group(function(){
	Route::get('/', 'WaliKelasController@dashboard')->name('wali_kelas.dashboard');
	Route::prefix('beasiswa')->group(function(){
		Route::get('/', 'WaliKelasController@beasiswa')->name('wali_kelas.beasiswa');
		Route::get('/pendaftar/kelas/{id}', 'WaliKelasController@pendaftarBeasiswaKelas')->name('wali_kelas.beasiswa.pendaftar.kelas');
		Route::post('/penilaian/submit/{beasiswa_id}/{nim}', 'WaliKelasController@penilaianBeasiswaSubmit')->name('wali_kelas.beasiswa.penilaian.submit');
		Route::get('/penilaian/{beasiswa_id}/{nim}', 'WaliKelasController@penilaianBeasiswa')->name('wali_kelas.beasiswa.penilaian');		
	});
});

Route::prefix('ketua_program_studi')->group(function(){
	Route::get('/', 'KetuaProgramStudiController@dashboard')->name('ketua_program_studi.dashboard');
	Route::prefix('beasiswa')->group(function(){
		Route::get('/', 'KetuaProgramStudiController@beasiswa')->name('ketua_program_studi.beasiswa');
		Route::get('/pendaftar/program_studi/{id}', 'KetuaProgramStudiController@pendaftarBeasiswaProgramStudi')->name('ketua_program_studi.beasiswa.pendaftar.program_studi');
		Route::post('/seleksi/program_studi/{beasiswa_id}', 'KetuaProgramStudiController@seleksiBeasiswaProgramStudi')->name('ketua_program_studi.beasiswa.seleksi.program_studi');		
	});
});

Route::prefix('ketua_jurusan')->group(function(){
	Route::get('/', 'KetuaJurusanController@dashboard')->name('ketua_jurusan.dashboard');
	Route::prefix('beasiswa')->group(function(){
		Route::get('/', 'KetuaJurusanController@beasiswa')->name('ketua_jurusan.beasiswa');
		Route::get('/pendaftar/jurusan/{id}', 'KetuaJurusanController@pendaftarBeasiswaJurusan')->name('ketua_jurusan.beasiswa.pendaftar.jurusan');
		Route::post('/seleksi/jurusan/{beasiswa_id}', 'KetuaJurusanController@seleksiBeasiswaJurusan')->name('ketua_jurusan.beasiswa.seleksi.jurusan');
	});
});

Route::prefix('mahasiswa')->group(function(){
	Route::get('/', 'MahasiswaController@dashboard')->name('mahasiswa.dashboard');

	Route::prefix('profil')->group(function(){
		Route::get('/', 'MahasiswaController@profile')->name('mahasiswa.profile');
		Route::get('/edit/', 'MahasiswaController@edit')->name('mahasiswa.edit');
		Route::patch('/update/', 'MahasiswaController@update')->name('mahasiswa.update');
	});

	Route::prefix('orang_tua')->group(function(){
		Route::get('/', 'MahasiswaController@getOrangTuaMahasiswa')->name('mahasiswa.orang_tua');
		Route::get('/create', 'MahasiswaController@createOrangTuaMahasiswa')->name('mahasiswa.orang_tua.create');
		Route::post('/store', 'MahasiswaController@storeOrangTuaMahasiswa')->name('mahasiswa.orang_tua.store');
		Route::get('/edit', 'MahasiswaController@editOrangTuaMahasiswa')->name('mahasiswa.orang_tua.edit');
		Route::patch('/update', 'MahasiswaController@updateOrangTuaMahasiswa')->name('mahasiswa.orang_tua.update');
	});

	Route::prefix('saudara')->group(function(){
		Route::get('/', 'MahasiswaController@getAllSaudaraMahasiswa')->name('mahasiswa.saudara');
		Route::get('/create', 'MahasiswaController@createSaudaraMahasiswa')->name('mahasiswa.saudara.create');
		Route::post('/store', 'MahasiswaController@storeSaudaraMahasiswa')->name('mahasiswa.saudara.store');
		Route::get('/edit/{id}', 'MahasiswaController@editSaudaraMahasiswa')->name('mahasiswa.saudara.edit');
		Route::patch('/update/{id}', 'MahasiswaController@updateSaudaraMahasiswa')->name('mahasiswa.saudara.update');
		Route::post('/destroy/{id}', 'MahasiswaController@destroySaudaraMahasiswa')->name('mahasiswa.saudara.destroy');
	});

	Route::prefix('sertifikat')->group(function(){
		Route::prefix('wajib')->group(function(){
			Route::get('/', 'MahasiswaController@getSertifikatWajib')->name('mahasiswa.sertifikat.wajib');
			Route::get('/create', 'MahasiswaController@createSertifikatWajib')->name('mahasiswa.sertifikat.wajib.create');
			Route::post('/store', 'MahasiswaController@storeSertifikatWajib')->name('mahasiswa.sertifikat.wajib.store');
		});

		Route::prefix('prestasi')->group(function(){
			Route::get('/', 'MahasiswaController@getSertifikatPrestasi')->name('mahasiswa.sertifikat.prestasi');
			Route::get('/create', 'MahasiswaController@createSertifikatPrestasi')->name('mahasiswa.sertifikat.prestasi.create');
			Route::post('/store', 'MahasiswaController@storeSertifikatPrestasi')->name('mahasiswa.sertifikat.prestasi.store');
			Route::get('/edit/{id}', 'MahasiswaController@editSertifikatPrestasi')->name('mahasiswa.sertifikat.prestasi.edit');
			Route::patch('/update/{id}', 'MahasiswaController@updateSertifikatPrestasi')->name('mahasiswa.sertifikat.prestasi.update');
			Route::post('/destroy/{id}', 'MahasiswaController@destroySertifikatPrestasi')->name('mahasiswa.sertifikat.prestasi.destroy');
		});

		Route::prefix('organisasi')->group(function(){
			Route::get('/', 'MahasiswaController@getSertifikatOrganisasi')->name('mahasiswa.sertifikat.organisasi');
			Route::get('/create', 'MahasiswaController@createSertifikatOrganisasi')->name('mahasiswa.sertifikat.organisasi.create');
			Route::post('/store', 'MahasiswaController@storeSertifikatOrganisasi')->name('mahasiswa.sertifikat.organisasi.store');
			Route::get('/edit/{id}', 'MahasiswaController@editSertifikatOrganisasi')->name('mahasiswa.sertifikat.organisasi.edit');
			Route::patch('/update/{id}', 'MahasiswaController@updateSertifikatOrganisasi')->name('mahasiswa.sertifikat.organisasi.update');
			Route::post('/destroy/{id}', 'MahasiswaController@destroySertifikatOrganisasi')->name('mahasiswa.sertifikat.organisasi.destroy');
		});

	});

	Route::prefix('berkas/wajib')->group(function(){
		Route::get('/', 'MahasiswaController@getBerkasWajib')->name('mahasiswa.berkas.wajib');
		Route::get('/create', 'MahasiswaController@createBerkasWajib')->name('mahasiswa.berkas.wajib.create');
		Route::post('/store', 'MahasiswaController@storeBerkasWajib')->name('mahasiswa.berkas.wajib.store');
	});

	Route::get('/beasiswa', 'MahasiswaController@beasiswa')->name('mahasiswa.beasiswa');
	Route::get('/beasiswa/show/{id}', 'MahasiswaController@showBeasiswa')->name('mahasiswa.beasiswa.show');
	Route::post('/beasiswa/pendaftaran/{beasiswa_id}', 'MahasiswaController@applyBeasiswa')->name('mahasiswa.beasiswa.apply');
});


Route::prefix('beasiswa')->group(function(){
	Route::get('/active', 'BeasiswaController@getActiveBeasiswa')->name('beasiswa.active');	
	Route::get('/{id}', 'BeasiswaController@show')->name('beasiswa.show');
	Route::get('/', 'BeasiswaController@index')->name('beasiswa.index');
});