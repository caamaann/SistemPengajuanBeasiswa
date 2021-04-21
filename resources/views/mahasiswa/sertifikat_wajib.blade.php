@extends('template')

@section('content')
<br>
<div class="container-fluid">
	@if(is_null($mahasiswa->sertifikat_ppkk) || is_null($mahasiswa->sertifikat_bn) || is_null($mahasiswa->sertifikat_butterfly) || is_null($mahasiswa->sertifikat_metagama) || is_null($mahasiswa->sertifikat_esq))
		<div class="alert alert-danger col-md-12">
			Sertifikat Wajib Belum Lengkap
		</div>
	@endif
	<a href="{{ route('mahasiswa.sertifikat.wajib.create') }}" class="btn btn-primary">Upload sertifikat wajib</a>	
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card justify-content-center" style="margin: 3%;">
				<div class="card-body">
					<h5 class="card-title">Sertifikat PPKK</h5>
					<hr>
					<br>
					<img src="{{ \Config::get('constants.sertifikat_wajib_path').$mahasiswa->sertifikat_ppkk }}" width="500px">		
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card justify-content-center" style="margin: 3%;">
				<div class="card-body">
					<h5 class="card-title">Sertifikat Bela Negara</h5>
					<hr>
					<br>
					<img src="{{ \Config::get('constants.sertifikat_wajib_path').$mahasiswa->sertifikat_bn }}" width="500px">
				</div>
			</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<div class="card justify-content-center" style="margin: 3%;">
				<div class="card-body">
					<h5 class="card-title">Sertifikat Character Building</h5>
					<hr>
					<br>
					<img src="{{ \Config::get('constants.sertifikat_wajib_path').$mahasiswa->sertifikat_butterfly }}" width="500px">		
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card justify-content-center" style="margin: 3%;">
				<div class="card-body">
					<h5 class="card-title">Sertifikat Metagama</h5>
					<hr>
					<br>
					<img src="{{ \Config::get('constants.sertifikat_wajib_path').$mahasiswa->sertifikat_metagama }}" width="500px">
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="card justify-content-center" style="margin: 3%;">
				<div class="card-body">
					<h5 class="card-title">Sertifikat ESQ</h5>
					<hr>
					<br>
					<img src="{{ \Config::get('constants.sertifikat_wajib_path').$mahasiswa->sertifikat_esq }}" width="500px">		
				</div>
			</div>
		</div>
		{{-- <div class="col-md-6">
			<div class="card justify-content-center" style="margin: 3%;">
				<div class="card-body">
					<h5 class="card-title">Sertifikat Metagama</h5>
					<hr>
					<br>
					<img src="{{ \Config::get('constants.sertifikat_wajib_path').$mahasiswa->sertifikat_metagama }}" width="500px">
				</div>
			</div>
		</div> --}}
	</div>
</div>
@endsection
