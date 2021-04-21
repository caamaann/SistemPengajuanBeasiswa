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
	@if($orangTua)
	<br>
	<br>
	<br>
	<br>
		<div class="col-md-8" style="margin:auto;">
		<div class="card">
			<div class="card-body" style="margin-top: 5%; margin-bottom: 5%;">
				<h4 style="text-align: center;">Data Orang Tua Mahasiswa</h4>
				<div class="row" style="margin-top: 5%;">
					<div class="col-md-3" style="text-align: center;">
						<img src="{{ asset('img/avatar.png') }}" height="150px">
						<h5>{{ $orangTua->nama_ayah }}</h5>
						<h7 style="font-family: 'Open Sans', sans-serif; color: #4b4f56;">Ayah</h7>

						
					</div>
					<div class="col-md-8" style="margin-left: 5%;">

						<div class="row">
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Tempat,Tanggal Lahir : </p>
								<p>{{ $orangTua->tempat_lahir_ayah }}, {{ $orangTua->tanggal_lahir_ayah }}</p>
				    		</div>
				    	</div>

						<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Alamat :  </p>
				    	<p>{{ $orangTua->alamat_ayah }}</p>

				    	<div class="row">
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Nomor HP :  </p>
				    			<p> {{ $orangTua->nomor_hp_ayah }}</p>
				    		</div>
				    		
				    	</div>


				    	<div class="row">
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Pekerjaan :  </p>
				    			<p> {{ $orangTua->pekerjaan_ayah }}</p>
				    		</div>
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Penghasilan :  </p>
				    			<p>{{ $orangTua->penghasilan_ayah }}</p>
				    		</div>
				    	</div>

				    	<div class="row">
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Pekerjaan Sambilan :  </p>
				    			<p> {{ $orangTua->pekerjaan_sambilan_ayah }}</p>
				    		</div>
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Penghasilan Sambilan :  </p>
				    			<p>{{ $orangTua->penghasilan_sambilan_ayah }}</p>
				    		</div>
				    	</div>
				    	<!-- <a href="{{ route('mahasiswa.orang_tua.edit') }}" class="btn btn-primary">Edit Data Orang Tua</a> -->
					</div>
				</div>
				<hr>
				<div class="row" style="margin-top: 5%;">
					<div class="col-md-3" style="text-align: center;">
						<img src="{{ asset('img/avatar2.svg') }}" height="150px">
						<h5>{{ $orangTua->nama_ibu }}</h5>
						<h7 style="font-family: 'Open Sans', sans-serif; color: #4b4f56;">Ibu</h7>

						
					</div>
					<div class="col-md-8" style="margin-left: 5%;">

						<div class="row">
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Tempat,Tanggal Lahir : </p>
								<p>{{ $orangTua->tempat_lahir_ibu }}, {{ $orangTua->tanggal_lahir_ibu }}</p>
				    		</div>
				    	</div>

						<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Alamat :  </p>
				    	<p>{{ $orangTua->alamat_ibu }}</p>

				    	<div class="row">
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Nomor HP :  </p>
				    			<p> {{ $orangTua->nomor_hp_ibu }}</p>
				    		</div>
				    		
				    	</div>


				    	<div class="row">
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Pekerjaan :  </p>
				    			<p> {{ $orangTua->pekerjaan_ibu }}</p>
				    		</div>
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Penghasilan :  </p>
				    			<p>{{ $orangTua->penghasilan_ibu }}</p>
				    		</div>
				    	</div>
				    	<div class="row">
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Pekerjaan Sambilan :  </p>
				    			<p> {{ $orangTua->pekerjaan_sambilan_ibu }}</p>
				    		</div>
				    		<div class="col-md-6">
				    			<p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #4b4f56;">Penghasilan Sambilan :  </p>
				    			<p>{{ $orangTua->penghasilan_sambilan_ibu }}</p>
				    		</div>
				    	</div>
				    	<!-- <a href="{{ route('mahasiswa.orang_tua.edit') }}" class="btn btn-primary">Edit Data Orang Tua</a> -->
					</div>
				</div>
				<div class="col-md-8" style="margin: auto;">
					<a href="{{ route('mahasiswa.orang_tua.edit') }}" class="btn btn-primary">Edit Data Orang Tua</a>
				</div>
			</div>
		</div>
	</div>
		<!-- <div class="card">
		  <div class="card-header">
		    Data Mahasiswa
		  </div>
		  <div class="card-body">
		    <blockquote class="blockquote mb-0">	      	    	
		    	<p>Nama : {{ $orangTua->nama_ayah }}</p>
		    	<p>Tempat Tanggal Lahir : {{ $orangTua->tempat_lahir_ayah }}, {{ $orangTua->tanggal_lahir_ayah }}</p>
		    	<p>Alamat Ayah : {{ $orangTua->alamat_ayah }}</p>
		    	<p>Nomor HP : {{ $orangTua->nomor_hp_ayah }}</p>
		    	<p>Pekerjaan Ayah : {{ $orangTua->pekerjaan_ayah }}</p>
		    	<p>Penghasilan Ayah : {{ $orangTua->penghasilan_ayah }}</p>
		    	<p>Pekerjaan Sambilan Ayah : {{ $orangTua->pekerjaan_sambilan_ayah }}</p>
		    	<p>Penghasilan Sambilan Ayah : {{ $orangTua->penghasilan_sambilan_ayah }}</p>
		    	<p>Nama : {{ $orangTua->nama_ibu }}</p>
		    	<p>Tempat Tanggal Lahir : {{ $orangTua->tempat_lahir_ibu }}, {{ $orangTua->tanggal_lahir_ibu }}</p>
		    	<p>Alamat Ibu : {{ $orangTua->alamat_ibu }}</p>
		    	<p>Nomor HP : {{ $orangTua->nomor_hp_ibu }}</p>
		    	<p>Pekerjaan Ibu : {{ $orangTua->pekerjaan_ibu }}</p>
		    	<p>Penghasilan Ibu : {{ $orangTua->penghasilan_ibu }}</p>
		    	<p>Pekerjaan Sambilan Ibu : {{ $orangTua->pekerjaan_sambilan_ibu }}</p>
		    	<p>Penghasilan Sambilan Ibu : {{ $orangTua->penghasilan_sambilan_ibu }}</p>
		    	<a href="{{ route('mahasiswa.orang_tua.edit') }}" class="btn btn-primary">Edit Data Orang Tua</a>
		    </blockquote>
		  </div>
		</div>		 -->
	@else
		<div class="alert alert-danger col-md-12">
			Belum menambahkan data orang tua
		</div>
		<div class="col-md-8">
			<a href="{{ route('mahasiswa.orang_tua.create') }}" class="btn btn-primary">Tambahkan Data Orang Tua</a>
		</div>		
	@endif
</div>
<br>
<br>
@endsection
