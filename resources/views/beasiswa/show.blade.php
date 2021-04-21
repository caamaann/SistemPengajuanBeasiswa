@extends('template')


@section('content')
	@yield('beasiswa_show_message')
	<div class="card">
	  <div class="card-header">
	    {{ $beasiswa->nama }}
	  </div>
	  <div class="card-body">
	    <blockquote class="blockquote mb-0">	      	    	
	    	<p>Deskripsi : {{ $beasiswa->deskripsi }}</p>
	    	<p>Biaya Pendidikan Per Semester : {{ $beasiswa->biaya_pendidikan_per_semester }}</p>
	    	<p>Persyaratan</p>
	    	<p>Penghasilan Orang Tua Maksimal : {{ $beasiswa->penghasilan_orang_tua_maksimal }}</p>
	    	<p>IPK Minimal : {{ $beasiswa->ipk_minimal }}</p>
	    	<p>Pendaftaran {{ $beasiswa->awal_pendaftaran }} s.d. {{ $beasiswa->akhir_pendaftaran }}</p>	
	    	<p>Periode Penerimaan {{ $beasiswa->awal_penerimaan }} s.d. {{ $beasiswa->akhir_penerimaan }}</p>	
	    	@yield('beasiswa_show_content')
	    </blockquote>
	  </div>
	</div>
@endsection