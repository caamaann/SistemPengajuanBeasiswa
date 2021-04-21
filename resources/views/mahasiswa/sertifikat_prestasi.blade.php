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
	<a href="{{ route('mahasiswa.sertifikat.prestasi.create') }}" class="btn btn-primary">Tambahkan Sertifikat</a>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
		  <thead>
		    <tr>
		      <th>No</th>
		      <th>Tingkat Prestasi</th>
		      <th>Gambar</th>	      
		      <th colspan="2">Action</th>
		    </tr>	    
		  </thead>
		  <tbody>
		  	@foreach($listSertifikat as $key => $sertifikat)	  	
		  	<tr>
		  		<td>{{ ++$key }}</td>
		  		<td>{{ $sertifikat->tingkat_prestasi }}</td>
		  		<td><img src="{{ \Config::get('constants.sertifikat_prestasi_path').$sertifikat->file_sertifikat }}" width="100px"></td>
		  		<td><a href="{{ route('mahasiswa.sertifikat.prestasi.edit', $sertifikat->id) }}" class="btn btn-primary">Ganti Sertifikat</a></td>
		  		<td>
		  			<form action="{{ route('mahasiswa.sertifikat.prestasi.destroy', $sertifikat->id) }}" method="POST">
		  				@csrf
		  				<button type="submit" class="btn btn-danger">Hapus Sertifikat</button>
		  			</form>
		  		</td>
		  	</tr>	    	    	
		    @endforeach
		  </tbody>
		</table>
	</div>	
</div>
@endsection