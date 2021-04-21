@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Insert') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('pembantu_direktur_3.beasiswa.store') }}">
                    @csrf                                
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>
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
                        <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi') }}</label>
                        <div class="col-md-6">
                            <textarea id="deskripsi" rows="3" class="form-control{{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" name="deskripsi" value="{{ old('deskripsi') }}" autofocus></textarea>
                            @if ($errors->has('deskripsi'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('deskripsi') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Biaya Pendidikan Per Semester') }}</label>
                        <div class="col-md-6">
                            <input id="biaya_pendidikan_per_semester" type="number" class="form-control{{ $errors->has('biaya_pendidikan_per_semester') ? ' is-invalid' : '' }}" name="biaya_pendidikan_per_semester" value="{{ old('biaya_pendidikan_per_semester') }}" required autofocus>
                            @if ($errors->has('biaya_pendidikan_per_semester'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('biaya_pendidikan_per_semester') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('IPK Minimal') }}</label>
                        <div class="col-md-6">
                            <input id="ipk_minimal" type="number" min="0" max="4" class="form-control{{ $errors->has('ipk_minimal') ? ' is-invalid' : '' }}" name="ipk_minimal" value="{{ old('ipk_minimal') }}" required autofocus>
                            @if ($errors->has('ipk_minimal'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ipk_minimal') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Penghasilan Orang Tua Maksimal') }}</label>
                        <div class="col-md-6">
                            <input id="penghasilan_orang_tua_maksimal" type="number" class="form-control{{ $errors->has('penghasilan_orang_tua_maksimal') ? ' is-invalid' : '' }}" name="penghasilan_orang_tua_maksimal" value="{{ old('penghasilan_orang_tua_maksimal') }}" required autofocus>
                            @if ($errors->has('penghasilan_orang_tua_maksimal'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('penghasilan_orang_tua_maksimal') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Awal Pendaftaran') }}</label>
                        <div class="col-md-6">
                            <input id="awal_pendaftaran" type="date" class="form-control{{ $errors->has('awal_pendaftaran') ? ' is-invalid' : '' }}" name="awal_pendaftaran" value="{{ old('awal_pendaftaran') }}" required autofocus>
                            @if ($errors->has('awal_pendaftaran'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('awal_pendaftaran') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Akhir Pendaftaran') }}</label>
                        <div class="col-md-6">
                            <input id="akhir_pendaftaran" type="date" class="form-control{{ $errors->has('akhir_pendaftaran') ? ' is-invalid' : '' }}" name="akhir_pendaftaran" value="{{ old('akhir_pendaftaran') }}" required autofocus>
                            @if ($errors->has('akhir_pendaftaran'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('akhir_pendaftaran') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Awal Penerimaan') }}</label>
                        <div class="col-md-6">
                            <input id="awal_penerimaan" type="date" class="form-control{{ $errors->has('awal_penerimaan') ? ' is-invalid' : '' }}" name="awal_penerimaan" value="{{ old('awal_penerimaan') }}" required autofocus>
                            @if ($errors->has('awal_penerimaan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('awal_penerimaan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Akhir Penerimaan') }}</label>
                        <div class="col-md-6">
                            <input id="akhir_penerimaan" type="date" class="form-control{{ $errors->has('akhir_penerimaan') ? ' is-invalid' : '' }}" name="akhir_penerimaan" value="{{ old('akhir_penerimaan') }}" required autofocus>
                            @if ($errors->has('akhir_penerimaan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('akhir_penerimaan') }}</strong>
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