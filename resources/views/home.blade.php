@extends('template')

@section('content')
<div id="background">
	<div class="col-md-12">
		<div class="row" style="margin: auto;">
			<div class="col-lg-6" style="margin: auto;">
				<h2 class="card-title" style="color: #fff; text-align: left; margin-left: 3%"> <b>Portal Online</b><br> Pendaftaran <b>Beasiswa</b> <br><b>Pol</b>iteknik Negeri <b>Ban</b>dung</h2>
			</div>
			<div class="col-lg-6" style="margin: auto; align-items: center; display: flex;">
				<img src="{{asset('img/platform.svg')}}" alt="Card image cap" width="400px" height="250px" style="margin:auto;">
			</div>
		</div>
	</div>
</div>
<br>
<br>
<div class="col-lg-6" style="margin: auto;">
	<div class="row">
		<div class="col-lg-6">
			<div class="card" style="border-radius: 30px;">
				<br>
				<img src="{{asset('img/list.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
				<div class="card-body">
					<h5 class="card-title" style="text-align: center;">List Beasiswa</h5>
					<a href="{{ route('beasiswa.index') }}" class="btn btn-primary">Lihat Beasiswa</a>
				</div>
			</div>
		</div>
			@if(Session::get('credential'))
				@php
	              $credential = Session::get('credential');
	              $roles = [];
	              foreach ($credential->user_data->roles as $role){
	                array_push($roles, $role->name);
	              }
	            @endphp
	            <div class="col-lg-6">
					<div class="card" style="border-radius: 30px;">
						<br>
						<img src="{{asset('img/platform.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
						<div class="card-body">
							@if (in_array('admin', $roles))
								<h5 class="card-title" style="text-align: center;">Dashboard Admin</h5>
								<a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard Admin</a>
							@endif
							@if (in_array('pd3', $roles))
								<h5 class="card-title" style="text-align: center;">Dashboard PD3</h5>
								<a href="{{ route('pembantu_direktur_3.dashboard') }}" class="btn btn-primary">Dashboard PD3</a>
							@endif
							@if (in_array('waliKelas', $roles))
								<h5 class="card-title" style="text-align: center;">Dashboard Wali Kelas</h5>
								<a href="{{ route('wali_kelas.dashboard') }}" class="btn btn-primary">Dashboard Wali Kelas</a>
							@endif
							@if (in_array('ketuaProdi', $roles))
								<h5 class="card-title" style="text-align: center;">Dashboard Ketua Prodi</h5>
								<a href="{{ route('ketua_program_studi.dashboard') }}" class="btn btn-primary">Dashboard Ketua Prodi</a>
							@endif
							@if (in_array('ketuaJurusan', $roles))
								<h5 class="card-title" style="text-align: center;">Dashboard Ketua Jurusan</h5>
								<a href="{{ route('ketua_jurusan.dashboard') }}" class="btn btn-primary">Dashboard Ketua Jurusan</a>
							@endif
							@if (in_array('mahasiswa', $roles))
								<h5 class="card-title" style="text-align: center;">Dashboard Mahasiswa</h5>
								<a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-primary">Dashboard Mahasiswa</a>
							@endif
						</div>
					</div>
				</div>	            
			@else				
				<div class="col-lg-6">
					<div class="card" style="border-radius: 30px;">
						<br>
						<img src="{{asset('img/login.svg')}}" alt="Card image cap" width="200px" height="200px" style="margin:auto;">
						<div class="card-body">
							<h5 class="card-title" style="text-align: center;">Login</h5>
							<a href="{{ route('auth.login_form') }}" class="btn btn-primary">Login</a>
						</div>
					</div>
				</div>
			@endif	
	</div>
</div>
@endsection