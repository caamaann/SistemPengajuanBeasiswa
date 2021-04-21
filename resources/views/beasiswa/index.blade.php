@extends('template')


@section('content')
@foreach($listBeasiswa as $key => $beasiswa)
	<div class="card" style="margin: 3%;">
		<div class="card-body">
			<h5 class="card-title"> {{ $beasiswa->nama }} </h5>
			<hr>
			<div class="row">
				<div class="col-md-3">
					<img src="{{asset('img/books.png')}}" alt="Card image cap" width="150px" style="margin:auto;">
				</div>
				<div class="col-md-9">
					<p>{{ $beasiswa->deskripsi }}</p>
					<p>Pendaftaran : {{ $beasiswa->awal_pendaftaran }} s.d. {{ $beasiswa->akhir_pendaftaran }}</p>
					<p>Biaya Pendidikan Per Semester : {{ $beasiswa->biaya_pendidikan_per_semester }}</p>
					{{-- <div class="row">
						<div class="col-md-3">
							<a href="/profile" class="btn btn-primary">Detail Beasiswa</a>
						</div>						
					</div>					 --}}
				</div>
			</div>
		</div>
	</div>
@endforeach
@endsection