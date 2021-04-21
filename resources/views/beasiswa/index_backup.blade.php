@extends('template')


@section('content')
<div class="table-responsive">
	<table class="table table-hover table-bordered">
	  <thead>
	    <tr>
	      <th rowspan="2">No</th>
	      <th rowspan="2">Nama</th>
	      <th rowspan="2">Deskripsi</th>
	      <th rowspan="2">Biaya Pendidikan Per Semester</th>
	      <th rowspan="2">Penghasilan Orang Tua Maksimal</th>
	      <th rowspan="2">IPK Minimal</th>
	      <th rowspan="2">Awal Pendaftaran</th>
	      <th rowspan="2">Akhir Pendaftaran</th>
	      <th rowspan="2">Awal Penerimaan</th>
	      <th rowspan="2">Akhir Penerimaan</th>
	      <th rowspan="2" colspan="2">Action</th>
	      <th colspan="3">Kuota Program Studi</th>      	      
	      <th rowspan="2" colspan="2">Action Kuota</th>
	    </tr>
	    <tr>	    	
	    	<th>Program Studi</th>
	      	<th>Kuota</th>
	      	<th>Angkatan</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($listBeasiswa as $key => $beasiswa)	  	
	    <tr>    	
	    	<td rowspan="{{ count($beasiswa->program_studi)+1 }}">{{ ++$key }}</td>
	    	<td rowspan="{{ count($beasiswa->program_studi)+1 }}">{{ $beasiswa->nama }}</td>
	    	<td rowspan="{{ count($beasiswa->program_studi)+1 }}">{{ $beasiswa->deskripsi }}</td>
	    	<td rowspan="{{ count($beasiswa->program_studi)+1 }}">{{ $beasiswa->biaya_pendidikan_per_semester }}</td>
	    	<td rowspan="{{ count($beasiswa->program_studi)+1 }}">{{ $beasiswa->penghasilan_orang_tua_maksimal }}</td>
	    	<td rowspan="{{ count($beasiswa->program_studi)+1 }}">{{ $beasiswa->ipk_minimal }}</td>
	    	<td rowspan="{{ count($beasiswa->program_studi)+1 }}">{{ $beasiswa->awal_pendaftaran }}</td>
	    	<td rowspan="{{ count($beasiswa->program_studi)+1 }}">{{ $beasiswa->akhir_pendaftaran }}</td>
	    	<td rowspan="{{ count($beasiswa->program_studi)+1 }}">{{ $beasiswa->awal_penerimaan }}</td>
	    	<td rowspan="{{ count($beasiswa->program_studi)+1 }}">{{ $beasiswa->akhir_penerimaan }}</td>	    	
		    <td rowspan="{{ count($beasiswa->program_studi)+1 }}">
		    	<a href="{{ route('beasiswa.edit', $beasiswa->id) }}" class="btn btn-primary">Edit Beasiswa</a>
		    </td>
		    <td rowspan="{{ count($beasiswa->program_studi)+1 }}">
		    	<form action="{{ route('beasiswa.destroy', $beasiswa->id) }}" method="POST">
		    		@csrf
		    		<button type="submit" class="btn btn-danger">Hapus Beasiswa</button>
		    		
		    	</form>
		    </td>
	    	@if(count($beasiswa->program_studi)==0)
		    	<td rowspan="{{ count($beasiswa->program_studi)+1 }}" colspan="3">Belum Memiliki Kuota</td>
		    	<td rowspan="{{ count($beasiswa->program_studi)+1 }}" colspan="2"><a href="{{ route('beasiswa.kuota.create', $beasiswa->id) }}" class="btn btn-primary">Insert Kuota</a></td>
	    	@endif
	    	
	    </tr>	    
	    	@foreach($beasiswa->program_studi as $key => $program_studi)
	    	<tr>
	    		<td>{{ $program_studi->nama }}</td>	    		
	    		<td>{{ $program_studi->pivot->kuota }}</td>
	    		<td>{{ $program_studi->pivot->angkatan }}</td>
	    		<td><a href="{{ route('beasiswa.kuota.edit', [$beasiswa->id, $program_studi->id, $program_studi->pivot->angkatan]) }}" class="btn btn-primary">Edit Kuota</a></td>
	    		<td>
	    			<form method="POST" action="{{ route('beasiswa.kuota.destroy', [$beasiswa->id, $program_studi->id, $program_studi->pivot->angkatan]) }}">
	    				@csrf
	    				<button type="submit" class="btn btn-danger">Hapus kuota beasiswa</button>
	    			</form>
	    			
	    		</td>
	    	</tr>
	    	@endforeach	    	
	    @endforeach
	  </tbody>
	</table>
</div>	
@endsection