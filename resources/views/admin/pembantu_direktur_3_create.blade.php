@extends('template')

@section('content')
<div class="card" style="margin: 3%;">
    <div class="card-body">
        <h5 class="card-title">Create Pembantu Direktur 3</h5>
        <hr>
        <br>
        <form method="POST" action="{{ route('admin.pembantu_direktur_3.store') }}">
            @csrf            
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">{{ __('Nama Pembantu Direktur 3') }}</label>
                <div class="col-md-6">
                    <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required autofocus>
                    @if ($errors->has('nama'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span>
                    @endif
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