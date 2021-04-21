@extends('template')


@section('content')
<br>
<div class="container-fluid">
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
		      <th>Nama ayah</th>
		      <th>Nama ibu</th>
		      <th>Pekerjaan Ayah</th>
		      <th>Pekerjaan Ibu</th>
		      <th>Penghasilan Ayah</th>
		      <th>Penghasilan Ibu</th>
		      <th>Jumlah tanggungan orang tua</th>
		      <th>Skor Kemampuan Ekonomi</th>
		      <th>Skor Prestasi</th>	      
		      <th>Skor Perilaku</th>	      
		      <th>Skor Organisasi</th>	      
		      <th colspan="2">Action</th>	      
		    </tr>	    
		  </thead>
		  <tbody>
		  	@foreach($listPendaftarKelas as $key => $pendaftarKelas)	  	
		    <tr>    	
		    	<td>{{ ++$key }}</td>
		    	<td>{{ $pendaftarKelas->nim }}</td>
		    	<td>{{ $pendaftarKelas->nama }}</td>
		    	<td>{{ $pendaftarKelas->tempat_lahir }} {{ $pendaftarKelas->tanggal_lahir }}</td>
		    	<td>{{ $pendaftarKelas->alamat }}</td>
		    	<td>{{ $pendaftarKelas->nomor_hp }}</td>
		    	<td>{{ $pendaftarKelas->email }}</td>
		    	<td>{{ $pendaftarKelas->ipk }}</td>
		    	<td>{{ $pendaftarKelas->beasiswa->pivot->skor_ipk }}</td>
		    	<td>{{ $pendaftarKelas->orang_tua_mahasiswa->nama_ayah}}</td>
		    	<td>{{ $pendaftarKelas->orang_tua_mahasiswa->nama_ibu}}</td>
		    	<td>{{ $pendaftarKelas->orang_tua_mahasiswa->pekerjaan_ayah}}</td>
		    	<td>{{ $pendaftarKelas->orang_tua_mahasiswa->pekerjaan_ibu}}</td>
		    	<td>{{ $pendaftarKelas->orang_tua_mahasiswa->penghasilan_ayah + $pendaftarKelas->orang_tua_mahasiswa->penghasilan_sambilan_ayah}}</td>
		    	<td>{{ $pendaftarKelas->orang_tua_mahasiswa->penghasilan_ibu + $pendaftarKelas->orang_tua_mahasiswa->penghasilan_sambilan_ibu}}</td>
		    	<td>{{ count($pendaftarKelas->saudara_mahasiswa) }}</td>
		    	<td>{{ $pendaftarKelas->beasiswa->pivot->skor_kemampuan_ekonomi }}</td>
		    	<td>{{ $pendaftarKelas->beasiswa->pivot->skor_prestasi }}</td>
		    	<td>{{ $pendaftarKelas->beasiswa->pivot->skor_perilaku }}</td>
		    	<td>{{ $pendaftarKelas->beasiswa->pivot->skor_organisasi }}</td>
		    	<td><a href="{{ route('wali_kelas.beasiswa.penilaian', [$pendaftarKelas->beasiswa->id, $pendaftarKelas->nim]) }}" class="btn btn-primary">Penilaian</a></td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
	</div>	
</div>
@endsection