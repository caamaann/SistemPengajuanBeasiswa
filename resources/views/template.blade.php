<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistem Pengajuan Beasiswa</title>        
    <link rel="stylesheet" type="text/css" href="{{ asset('/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-home.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    @yield('stylesheets')
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary-polban" style="text-align: center;">
      <a class="navbar-brand" href="{{ route('home') }}"><strong>Beasiswa</strong> Polban</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          @if(Session::get('credential'))
            <li class="nav-item">
              <a class="nav-link" href="#">{{ Session::get('credential')->user_data->username }}</a>
            </li>
            @php
              $credential = Session::get('credential');
              $roles = [];
              foreach ($credential->user_data->roles as $role){
                array_push($roles, $role->name);
              }
            @endphp          
            @if (in_array('admin', $roles))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            </li>
            @endif
            @if(in_array('pd3', $roles))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('pembantu_direktur_3.dashboard') }}">Pembantu Direktur 3 Dashboard</a>
            </li>
            @endif
            @if(in_array('waliKelas', $roles))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('wali_kelas.dashboard') }}">Wali Kelas Dashboard</a>
            </li>
            @endif
            @if(in_array('ketuaProdi', $roles))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('ketua_program_studi.dashboard') }}">Ketua Program Studi Dashboard</a>
            </li>
            @endif
            @if(in_array('ketuaJurusan', $roles))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('ketua_jurusan.dashboard') }}">Ketua Jurusan Dashboard</a>
            </li>
            @endif
            @if(in_array('mahasiswa', $roles))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">Mahasiswa Dashboard</a>
            </li>
            @endif
            <form method="post" action="{{ route('auth.logout') }}" class="form-inline my-2 my-lg-0">
              @csrf
              <li class="nav-item">
                <button class="btn my-2 my-sm-0" type="submit">Logout</button>
              </li>  
            </form>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('auth.login_form') }}">Login</a>
            </li>
          @endif
        </ul>    
      </div>
    </nav>    
    @yield('content')
    <br>
    <br>
    <br>
    <div style="text-align: center; color: #fff; margin: auto;" id="background">
      <p>Tim PKM</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  
    @yield('javascripts')
  </body>
</html>