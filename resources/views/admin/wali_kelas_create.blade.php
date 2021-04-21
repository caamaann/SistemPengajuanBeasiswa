@extends('template')

@section('stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
<div class="card" style="margin: 3%;">
    <div class="card-body">
        <h5 class="card-title">Create Wali Kelas</h5>
        <hr>
        <br>
        <form method="POST" action="{{ route('admin.wali_kelas.store') }}">
            @csrf            
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">{{ __('Nama Wali Kelas') }}</label>
                <div class="col-md-6">
                    <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required autofocus>
                    @if ($errors->has('nama'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">{{ __('Program Studi') }}</label>
                <div class="col-md-6">
                    <select class="form-control select2" name="program_studi_id">
                        @foreach($listProgramStudi as $programStudi)
                            <option value="{{$programStudi->id}}">{{$programStudi->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <hr>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                    </button>
                </div>
            </div>
        </form>
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