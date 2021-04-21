@extends('template')

@section('content')
<style>
td{
	margin: auto;
	font-size: 16px;
	font-family: 'Open Sans', sans-serif;
	padding: 10px;
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
	<br>
	<br>
	<br>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
		  <thead>
		    <tr>
		      <th>No</th>
		      <th>Nama</th>
		      <th>Usia</th>
		      <th>Status Saudara</th>
		      <th>Status Pekerjaan</th>		      
		      <th>Status Pernikahan</th>
		      <th colspan="2">Action</th>	      
		    </tr>	    
		  </thead>
		  <tbody>
		  	@foreach($listSaudaraMahasiswa as $key => $saudaraMahasiswa)	  	
		    <tr>    	
		    	<td>{{ ++$key }}</td>
		    	<td>{{ $saudaraMahasiswa->nama }}</td>
		    	<td>{{ $saudaraMahasiswa->usia }}</td>
		    	<td>{{ $saudaraMahasiswa->status_saudara }}</td>
		    	<td>{{ $saudaraMahasiswa->status_pekerjaan }}</td>		    	
		    	<td>{{ $saudaraMahasiswa->status_pernikahan }}</td>
		    	<td><a href="{{ route('mahasiswa.saudara.edit', $saudaraMahasiswa->id) }}" class="btn btn-primary">Edit Data Saudara</a></td>
		    	<td>
		    		<form action="{{ route('mahasiswa.saudara.destroy', $saudaraMahasiswa->id) }}" method="POST">
		    			@csrf
		    			<button type="submit" class="btn btn-danger">Hapus data saudara</button>
		    			
		    		</form>
		    	</td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
	</div>
		<a href="{{ route('mahasiswa.saudara.create') }}" class="btn btn-primary">Tambahkan Data Saudara</a>
</div>
@endsection
