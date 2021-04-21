<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistem Pengajuan Beasiswa</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>  
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
  <div class="container">    
    <div class="img">
      <img src="{{ asset('img/certif.png') }}">
    </div>
    <div class="login-content">
      <form method="POST" action="{{ route('auth.login') }}">
        @csrf
        <img src="{{ asset('img/avatar.png') }}">
        <h2 class="title">Welcome</h2>
              <div class="input-div one">
                 <div class="i">
                    <i class="fas fa-user"></i>
                 </div>
                 <div class="div">
                    <h5>Username</h5>
                    <input type="text" class="input" name="username">
                 </div>
              </div>
              <div class="input-div pass">
                 <div class="i"> 
                    <i class="fas fa-lock"></i>
                 </div>
                 <div class="div">
                    <h5>Password</h5>
                    <input type="password" class="input" name="password">
                 </div>
              </div>              
              <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>
</html>