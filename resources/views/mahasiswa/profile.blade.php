@extends('template')

@section('content')
<style>
p{
	font-size: 16px;
}
</style>

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
	@if($kelengkapanDataMahasiswa)
<br>
<br>
<br>
<br>
	<div class="col-md-8" style="margin:auto;">
		<div class="card">
			<div class="card-body" style="margin-top: 5%; margin-bottom: 5%;">
				<div class="row">
					<div class="col-md-3" style="text-align: center;">
						<img src="{{ asset('img/avatar.png') }}" height="150px">
						<h5>{{$mahasiswa->nama}}</h5>
						<h7 style="font-family: 'Open Sans', sans-serif; color: #4b4f56;">Mahasiswa</h7>
						<h5>{{ $mahasiswa->nim }}</h5>
					</div>
					<div class="col-md-8" style="margin-left: 5%;">

						<div class="row">
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Tempat,Tanggal Lahir : </p>
								<p>{{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tanggal_lahir }}</p>
				    		</div>
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Gender :  </p>
				    			<p>{{ $mahasiswa->gender=="l" ? "Laki-laki" : "Perempuan" }}</p>
				    		</div>
				    	</div>

						<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Alamat :  </p>
				    	<p>{{ $mahasiswa->alamat }}, Kode Pos {{ $mahasiswa->kode_pos }}, {{ $mahasiswa->kota }}</p>

				    	<div class="row">
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Nomor HP :  </p>
				    			<p> {{ $mahasiswa->nomor_hp }}</p>
				    		</div>
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Email :  </p>
				    			<p> {{ $mahasiswa->email }}</p>
				    		</div>
				    	</div>


				    	<div class="row">
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Rekening :  </p>
				    			<p> {{ $mahasiswa->nama_bank }}</p>
				    		</div>
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Nomor Rekening :  </p>
				    			<p>{{ $mahasiswa->nomor_rekening }}</p>
				    		</div>
				    	</div>
				    	<a href="{{ route('mahasiswa.edit') }}" class="btn btn-primary">Edit Data Mahasiswa</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<!-- 		<div class="card">
		  <div class="card-header">
		    Data Mahasiswa
		  </div>
		  <div class="card-body">
		    <blockquote class="blockquote mb-0">	      	    	
		    	<p>NIM : {{ $mahasiswa->nim }}</p>
		    	<p>Nama : {{ $mahasiswa->nama }}</p>
		    	<p>Tempat Tanggal Lahir : {{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tanggal_lahir }}</p>
		    	<p>Alamat : {{ $mahasiswa->alamat }}, Kode Pos {{ $mahasiswa->kode_pos }}, {{ $mahasiswa->kota }}</p>
		    	<p>Nomor HP : {{ $mahasiswa->nomor_hp }}</p>
		    	<p>Email : {{ $mahasiswa->email }}</p>		    	
		    	<p>Gender : {{ $mahasiswa->gender=="l" ? "Laki-laki" : "Perempuan" }}</p>
		    	<p>Rekening : {{ $mahasiswa->nama_bank }}</p>
		    	<p>Nomor Rekening : {{ $mahasiswa->nomor_rekening }}</p>		    	
		    	<a href="{{ route('mahasiswa.edit') }}" class="btn btn-primary">Edit Data Mahasiswa</a>
		    </blockquote>
		  </div>
		</div> -->
	@else
		<div class="alert alert-danger col-md-12">
			Data Mahasiswa Belum Lengkap
		</div>
		<a href="{{ route('mahasiswa.edit') }}" class="btn btn-primary">Lengkapi Data Mahasiswa</a>
	@endif
</div>
@endsection