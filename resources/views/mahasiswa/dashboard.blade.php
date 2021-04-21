@extends('template')

@section('content')
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
	<br>
	<div class="row justify-content-center">
		<div class="col-lg-3">
			<div class="card" style="border-radius: 15px; margin-bottom: 10%;">
				<br>
				<img src="{{asset('img/list.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">List Beasiswa</h5>
					<a href="{{ route('mahasiswa.beasiswa') }}" class="btn btn-primary">List Beasiswa</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 15px; margin-bottom: 10%;">
				<br>
				<img src="{{asset('img/datadiri.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Profil Mahasiswa</h5>
					<a href="{{ route('mahasiswa.profile') }}" class="btn btn-primary">Profil Mahasiswa</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 15px; margin-bottom: 10%;">
				<br>
				<img src="{{asset('img/keluarga.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Profil Orang Tua</h5>
					<a href="{{ route('mahasiswa.orang_tua') }}" class="btn btn-primary">Profil Orang Tua</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 15px; margin-bottom: 10%;">
				<br>
				<img src="{{asset('img/datasodara.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center; font-size: 19px;">Data Saudara Mahasiswa</h5>
					<a href="{{ route('mahasiswa.saudara') }}" class="btn btn-primary" style="font-size: 16px;">Data Saudara Mahasiswa</a>
				</div>
			</div>
		</div>	
		<div class="col-lg-3">
			<div class="card" style="border-radius: 15px; margin-bottom: 10%;">
				<br>
				<img src="{{asset('img/berkaswajib.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Berkas Wajib</h5>
					<a href="{{ route('mahasiswa.berkas.wajib') }}" class="btn btn-primary">Berkas Wajib</a>
				</div>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="card" style="border-radius: 15px; margin-bottom: 10%;">
				<br>
				<img src="{{asset('img/sertifikatwajib.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Sertifikat Wajib</h5>
					<a href="{{ route('mahasiswa.sertifikat.wajib') }}" class="btn btn-primary">Sertifikat Wajib</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 15px; margin-bottom: 10%;">
				<br>
				<img src="{{asset('img/ganti.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Sertifikat Organisasi</h5>
					<a href="{{ route('mahasiswa.sertifikat.organisasi') }}" class="btn btn-primary">Sertifikat Organisasi</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 15px; margin-bottom: 10%;">
				<br>
				<img src="{{asset('img/sertifikatprestasi.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Sertifikat Prestasi</h5>
					<a href="{{ route('mahasiswa.sertifikat.prestasi') }}" class="btn btn-primary">Sertifikat Prestasi</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
