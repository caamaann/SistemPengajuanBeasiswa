@extends('template')


@section('content')
<br>
<div class="container-fluid">
	<a href="{{ route('pembantu_direktur_3.beasiswa.create') }}" class="btn btn-primary">Tambah Beasiswa</a>	
	<div class="table-responsive">
	<table class="table table-hover table-bordered">
	  <thead>
	    <tr>
	      <th>No</th>
	      <th>Nama</th>
	      <th>Deskripsi</th>
	      <th>Biaya Pendidikan Per Semester</th>
	      <th>Penghasilan Orang Tua Maksimal</th>
	      <th>IPK Minimal</th>
	      <th>Awal Pendaftaran</th>
	      <th>Akhir Pendaftaran</th>
	      <th>Awal Penerimaan</th>
	      <th>Akhir Penerimaan</th>
	      <th colspan="4">Action</th>	      
	    </tr>	    
	  </thead>
	  <tbody>
	  	@foreach($listBeasiswa as $key => $beasiswa)	  	
	    <tr>    	
	    	<td>{{ ++$key }}</td>
	    	<td>{{ $beasiswa->nama }}</td>
	    	<td>{{ $beasiswa->deskripsi }}</td>
	    	<td>{{ $beasiswa->biaya_pendidikan_per_semester }}</td>
	    	<td>{{ $beasiswa->penghasilan_orang_tua_maksimal }}</td>
	    	<td>{{ $beasiswa->ipk_minimal }}</td>
	    	<td>{{ $beasiswa->awal_pendaftaran }}</td>
	    	<td>{{ $beasiswa->akhir_pendaftaran }}</td>
	    	<td>{{ $beasiswa->awal_penerimaan }}</td>
	    	<td>{{ $beasiswa->akhir_penerimaan }}</td>	    	
	    	<td>
		    	<a href="{{ route('pembantu_direktur_3.beasiswa.pendaftar', $beasiswa->id) }}" class="btn btn-primary">Pendaftar</a>
		    </td>
		    <td>
		    	<a href="{{ route('pembantu_direktur_3.beasiswa.edit', $beasiswa->id) }}" class="btn btn-primary">Edit</a>
		    </td>
		    <td>
		    	<form action="{{ route('pembantu_direktur_3.beasiswa.destroy', $beasiswa->id) }}" method="POST">
		    		@csrf
		    		<button type="submit" class="btn btn-danger">Hapus</button>
		    	</form>
		    </td>
		    <td>
		    	<a href="{{ route('pembantu_direktur_3.beasiswa.kuota', $beasiswa->id) }}" class="btn btn-primary">Kuota</a>
		    </td>
	    </tr>	    	    	
	    @endforeach
	  </tbody>
	</table>
</div>
</div>
@endsection