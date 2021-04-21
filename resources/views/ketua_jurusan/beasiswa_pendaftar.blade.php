@extends('template')


@section('content')	
<br>
<div class="container-fluid">
	@if($jumlahPendaftarJurusan <= 0)
		<div class="alert alert-danger col-md-12">
			Tidak ada pendaftar beasiswa
		</div>	
	@else
		<form action="{{ route('ketua_jurusan.beasiswa.seleksi.jurusan', $beasiswaId) }}" method="POST">
			@csrf
			<button type="submit" class="btn btn-primary">Submit Pendaftar ke Tingkat Pusat</button>
		</form>
		@foreach($listPendaftarJurusan as $pendaftarJurusan)
			<h5>Angkatan : {{ $pendaftarJurusan->angkatan }}</h5>			
			<h5>Pendaftar : {{ count($pendaftarJurusan->pendaftarBeasiswa) }}</h5> 
			@if (count($pendaftarJurusan->pendaftarBeasiswa) > 0)			
				<div class="table-responsive">
					<table class="table table-hover table-bordered">
					  <thead>
					    <tr>
					      <th>No</th>
					      <th>NIM</th>
					      <th>Nama</th>
					      <th>Tempat Tanggal Lahir</th>
					      <th>Alamat</th>
					      <th>Nomor HP</th>
					      <th>Email</th>
					      <th>IPK</th>
					      <th>Skor IPK</th>	      
					      <th>Skor Kemampuan Ekonomi</th>
					      <th>Skor Prestasi</th>	      
					      <th>Skor Perilaku</th>	      
					      <th>Skor Organisasi</th>	      
					      <th>Skor Akhir</th>	      				      
					    </tr>	    
					  </thead>
					  <tbody>
					  	@foreach($pendaftarJurusan->pendaftarBeasiswa as $key => $pendaftarBeasiswa)
					    <tr>    	
					    	<td>{{ ++$key }}</td>
					    	<td>{{ $pendaftarBeasiswa->nim }}</td>
					    	<td>{{ $pendaftarBeasiswa->nama }}</td>
					    	<td>{{ $pendaftarBeasiswa->tempat_lahir }} {{ $pendaftarBeasiswa->tanggal_lahir }}</td>
					    	<td>{{ $pendaftarBeasiswa->alamat }}</td>
					    	<td>{{ $pendaftarBeasiswa->nomor_hp }}</td>
					    	<td>{{ $pendaftarBeasiswa->email }}</td>
					    	<td>{{ $pendaftarBeasiswa->ipk }}</td>
					    	<td>{{ $pendaftarBeasiswa->skor_ipk }}</td>	    		    	
					    	<td>{{ $pendaftarBeasiswa->skor_kemampuan_ekonomi }}</td>
					    	<td>{{ $pendaftarBeasiswa->skor_prestasi }}</td>
					    	<td>{{ $pendaftarBeasiswa->skor_perilaku }}</td>
					    	<td>{{ $pendaftarBeasiswa->skor_organisasi }}</td>
					    	<td>{{ $pendaftarBeasiswa->skor_akhir }}</td>			    	
					    </tr>
					    @endforeach
					  </tbody>
					</table>
				</div>
			@endif
		@endforeach	
	@endif
</div>
@endsection