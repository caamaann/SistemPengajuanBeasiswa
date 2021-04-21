@extends('template')

@section('stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Insert') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('pembantu_direktur_3.beasiswa.kuota.store') }}">
                    @csrf
                    <input type="hidden" name="beasiswa_id" value="{{ $beasiswa->id }}">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>
                        <div class="col-md-6">
                            <input id="nama_beasiswa" type="text" min="0" class="form-control" name="nama_beasiswa" value="{{ $beasiswa->nama }}" readonly="readonly">
                            @if ($errors->has('nama_beasiswa'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nama_beasiswa') }}</strong>
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
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Angkatan') }}</label>
                        <div class="col-md-6">
                            <input id="angkatan" type="number" min="0" class="form-control{{ $errors->has('angkatan') ? ' is-invalid' : '' }}" name="angkatan" value="{{ old('angkatan') }}" required autofocus>
                            @if ($errors->has('angkatan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('angkatan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Kuota') }}</label>
                        <div class="col-md-6">
                            <input id="kuota" type="number" min="0" class="form-control{{ $errors->has('kuota') ? ' is-invalid' : '' }}" name="kuota" value="{{ old('kuota') }}" required autofocus>
                            @if ($errors->has('kuota'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('kuota') }}</strong>
                            </span>
                            @endif
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