@extends('template')

@section('content')
<br>
<div class="container-fluid">
	@if (\Session::has('success'))
	<div class="row">
	    <div class="alert alert-success col-md-12">
	        <p>{{ \Session::get('success') }}</p>
	    </div>
	</div>
	@elseif (\Session::has('fail'))
	<div class="row">
	    <div class="alert alert-danger col-md-12">
	        <p>{{ \Session::get('fail') }}</p>
	    </div>
	</div>
	@endif
	@if(is_null($mahasiswa->file_ktm) || is_null($mahasiswa->file_kk) || is_null($mahasiswa->file_transkrip_nilai))
		<div class="alert alert-danger col-md-12">
			Berkas Belum Lengkap
		</div>
	@endif
	<a href="{{ route('mahasiswa.berkas.wajib.create') }}" class="btn btn-primary">Upload sertifikat wajib</a>
	<div class="row">
		<div class="col-md-6">
			<div class="card justify-content-center" style="margin: 3%;">
				<div class="card-body">
					<h5 class="card-title">Kartu Tanda Mahasiswa</h5>
					<hr>
					<br>
					<img src="{{ \Config::get('constants.berkas_wajib_path').$mahasiswa->file_ktm }}" width="500px">		
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card justify-content-center" style="margin: 3%;">
				<div class="card-body">
					<h5 class="card-title">Kartu Keluarga</h5>
					<hr>
					<br>
					<img src="{{ \Config::get('constants.berkas_wajib_path').$mahasiswa->file_kk }}" width="500px">
				</div>
			</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<div class="card justify-content-center" style="margin: 3%;">
				<div class="card-body">
					<h5 class="card-title">Transkrip Nilai</h5>
					<hr>
					<br>
					<img src="{{ \Config::get('constants.berkas_wajib_path').$mahasiswa->file_transkrip_nilai }}" width="500px">		
				</div>
			</div>
		</div>		
	</div>
</div>
@endsection
