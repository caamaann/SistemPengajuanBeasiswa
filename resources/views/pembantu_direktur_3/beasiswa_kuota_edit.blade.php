@extends('template')

@section('content')
<br>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Kuota Beasiswa') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('beasiswa.kuota.update') }}">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="beasiswa_id" value="{{ $kuotaBeasiswa->id }}">
                        <input type="hidden" name="program_studi_id" value="{{ $kuotaBeasiswa->programStudi->id }}">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Nama Beasiswa') }}</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ $kuotaBeasiswa->nama }}" disabled="disabled">                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Program Studi') }}</label>
                            <div class="col-md-6">
                                <input id="program_studi" type="text" class="form-control" name="program_studi" value="{{ $kuotaBeasiswa->programStudi->nama }}" disabled="disabled">                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Angkatan') }}</label>
                            <div class="col-md-6">
                                <input id="angkatan" type="number" class="form-control" name="angkatan" value="{{ $kuotaBeasiswa->programStudi->pivot->angkatan }}" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Kuota') }}</label>
                            <div class="col-md-6">
                                <input id="angkatan" type="number" class="form-control" name="kuota" value="{{ $kuotaBeasiswa->programStudi->pivot->kuota }}">
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
</div>
@endsection