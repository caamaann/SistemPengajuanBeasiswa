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
	<br>
	<div class="row justify-content-center">
		{{-- <div class="col-lg-3">
			<div class="card" style="border-radius: 30px; margin-bottom: 10px;">
				<br>
				<img src="{{asset('img/student.png')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Insert Mahasiswa</h5>
					<a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">Insert Mahasiswa</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 30px; margin-bottom: 10px;">
				<br>
				<img src="{{asset('img/datadiri.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Insert Wali Kelas</h5>
					<a href="{{ route('admin.wali_kelas.create') }}" class="btn btn-primary">Insert Wali Kelas</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 30px; margin-bottom: 10px;">
				<br>
				<img src="{{asset('img/datadiri.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Insert Ketua Program Studi</h5>
					<a href="{{ route('admin.ketua_program_studi.create') }}" class="btn btn-primary">Insert Ketua Program Studi</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 30px; margin-bottom: 10px;">
				<br>
				<img src="{{asset('img/datadiri.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Insert Ketua Jurusan</h5>
					<a href="{{ route('admin.ketua_jurusan.create') }}" class="btn btn-primary">Insert Ketua Jurusan</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 30px; margin-bottom: 10px;">
				<br>
				<img src="{{asset('img/datadiri.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Insert Pembantu Direktur 3</h5>
					<a href="{{ route('admin.pembantu_direktur_3.create') }}" class="btn btn-primary">Insert Pembantu Direktur 3</a>
				</div>
			</div>
		</div> --}}
		<div class="col-lg-3">
			<div class="card" style="border-radius: 30px; margin-bottom: 10px;">
				<br>
				<img src="{{asset('img/student.png')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Mahasiswa</h5>
					<a href="{{ route('admin.mahasiswa') }}" class="btn btn-primary">Mahasiswa</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 30px; margin-bottom: 10px;">
				<br>
				<img src="{{asset('img/datadiri.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Wali Kelas</h5>
					<a href="{{ route('admin.wali_kelas') }}" class="btn btn-primary">Wali Kelas</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 30px; margin-bottom: 10px;">
				<br>
				<img src="{{asset('img/datadiri.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Ketua Program Studi</h5>
					<a href="{{ route('admin.ketua_program_studi') }}" class="btn btn-primary">Ketua Program Studi</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 30px; margin-bottom: 10px;">
				<br>
				<img src="{{asset('img/datadiri.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Ketua Jurusan</h5>
					<a href="{{ route('admin.ketua_jurusan') }}" class="btn btn-primary">Ketua Jurusan</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card" style="border-radius: 30px; margin-bottom: 10px;">
				<br>
				<img src="{{asset('img/datadiri.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">Pembantu Direktur 3</h5>
					<a href="{{ route('admin.pembantu_direktur_3') }}" class="btn btn-primary">Pembantu Direktur 3</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
