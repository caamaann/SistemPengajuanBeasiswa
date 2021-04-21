@extends('beasiswa.show')

@section('beasiswa_show_message')
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
	        @if(\Session::get('fail') == "Profil mahasiswa belum lengkap")
	        	<a href="{{ route('mahasiswa.edit') }}">Lengkapi Profil Mahasiswa</a>
	        @endif
	        @if(\Session::get('fail') == "Data orang tua mahasiswa belum lengkap")
	        	<a href="{{ route('mahasiswa.orang_tua.create') }}">Lengkapi Data Orang Tua Mahasiswa</a>
	        @endif
	        @if(\Session::get('fail') == "Berkas belum lengkap")
	        	<a href="{{ route('mahasiswa.berkas.wajib.create') }}">Lengkapi Berkas Wajib</a>
	        @endif
	        @if(\Session::get('fail') == "Sertifikat wajib belum lengkap")
	        	<a href="{{ route('mahasiswa.sertifikat.wajib.create') }}">Lengkapi Sertifikat Wajib</a>
	        @endif
	    </div>
	</div>
	@endif
@endsection

@section('beasiswa_show_content')
	<form action="{{ route('mahasiswa.beasiswa.apply', $beasiswa->id) }}" method="POST">
		@csrf
		<button type="submit" class="btn btn-primary">Daftar Beasiswa</button>
	</form>
</div>
@endsection
