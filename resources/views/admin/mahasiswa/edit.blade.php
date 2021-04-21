@extends('template')

@section('stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
<br>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Edit') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" style="font-family: roboto;">{{ __('NIM') }}</label>
                        <div class="col-md-6">
                            <input id="nim" type="number" min="0" class="form-control{{ $errors->has('nim') ? ' is-invalid' : '' }}" name="nim" value="{{ $mahasiswa->nim }}" required autofocus>
                            @if ($errors->has('nim'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nim') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>
                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ $mahasiswa->nama }}" required autofocus>
                            @if ($errors->has('nama'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $mahasiswa->email }}" required autofocus>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Semester') }}</label>
                        <div class="col-md-6">
                            <input id="semester" type="number" min="0" max="8" class="form-control{{ $errors->has('semester') ? ' is-invalid' : '' }}" name="semester" value="{{ $mahasiswa->semester }}" required autofocus>
                            @if ($errors->has('semester'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('semester') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Angkatan') }}</label>
                        <div class="col-md-6">
                            <input id="angkatan" type="number" min="0" class="form-control{{ $errors->has('angkatan') ? ' is-invalid' : '' }}" name="angkatan" value="{{ $mahasiswa->angkatan }}" required autofocus>
                            @if ($errors->has('angkatan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('angkatan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('IPK') }}</label>
                        <div class="col-md-6">
                            <input id="ipk" type="number" min="0" max="4" step="0.01" class="form-control{{ $errors->has('ipk') ? ' is-invalid' : '' }}" name="ipk" value="{{ $mahasiswa->ipk }}" required autofocus>
                            @if ($errors->has('ipk'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ipk') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Program Studi') }}</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="program_studi_id">
                                @foreach($listProgramStudi as $programStudi)
                                    <option value="{{$programStudi->id}}">{{$programStudi->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Wali Kelas') }}</label>
                        <div class="col-md-6">
                            <select class="form-control select2" name="wali_kelas_id">
                                @foreach($listWaliKelas as $waliKelas)
                                    <option value="{{$waliKelas->id}}">{{$waliKelas->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.select2').select2();
      });
  </script>
@endsection