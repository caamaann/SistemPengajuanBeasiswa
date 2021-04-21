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
	<a href="{{ route('admin.ketua_jurusan.create') }}" class="btn btn-primary">Insert</a>	
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
		  <thead>
		    <tr>
		      <th>No</th>
		      <th>NIP</th>
		      <th>Nama</th>
		      <th>Jurusan</th>
		      <th colspan="2">Action</th>
		    </tr>			    
		  </thead>
		  <tbody>
		  	@foreach($listKetuaJurusan as $key => $ketuaJurusan)	  	
		    <tr>    	
		    	<td>{{ ++$key }}</td>
		    	<td>{{ $ketuaJurusan->nip }}</td>
		    	<td>{{ $ketuaJurusan->nama }}</td>
		    	<td>{{ $ketuaJurusan->jurusan->nama }}</td>
		    	<td><a href="{{ route('admin.ketua_jurusan.edit', $ketuaJurusan->id) }}" class="btn btn-primary">Edit</a></td>
		    	<td><form method="POST" action="{{ route('admin.ketua_jurusan.destroy', $ketuaJurusan->id) }}">
		    		@csrf
		    		<button type="submit" class="btn btn-danger">Hapus</button>
		    	</form></td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
	</div>
</div>
@endsection
