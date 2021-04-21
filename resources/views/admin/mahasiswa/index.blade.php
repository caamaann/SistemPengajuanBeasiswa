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
	<a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">Insert</a>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
		  <thead>
		    <tr>
		      <th>No</th>
		      <th>NIM</th>
		      <th>Nama</th>
		      <th>Email</th>
		      <th>IPK</th>
		      <th>Semester</th>
		      <th>Angkatan</th>
		      <th>Status Keaktifan</th>
		      <th>Wali Kelas</th>
		      <th>Program Studi</th>
		      <th colspan="2">Action</th>
		    </tr>			    
		  </thead>
		  <tbody>
		  	@foreach($listMahasiswa as $key => $mahasiswa)	  	
		    <tr>    	
		    	<td>{{ ++$key }}</td>
		    	<td>{{ $mahasiswa->nim }}</td>
		    	<td>{{ $mahasiswa->nama }}</td>
		    	<td>{{ $mahasiswa->email }}</td>
		    	<td>{{ $mahasiswa->ipk }}</td>
		    	<td>{{ $mahasiswa->semester }}</td>
		    	<td>{{ $mahasiswa->angkatan }}</td>
		    	<td>{{ $mahasiswa->status_keaktifan }}</td>
		    	<td>{{ $mahasiswa->wali_kelas->nama }}</td>
		    	<td>{{ $mahasiswa->program_studi->nama }}</td>
		    	<td><a href="{{ route('admin.mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-primary">Edit</a></td>
		    	<td><form method="POST" action="{{ route('admin.mahasiswa.destroy', $mahasiswa->id) }}">
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
