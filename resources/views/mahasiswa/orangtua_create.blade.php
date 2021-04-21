@extends('template')
@section('content')
<br>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Orang Tua Mahasiswa') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('mahasiswa.orang_tua.store') }}">
                        @csrf                                
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Nama Ayah') }}</label>
                            <div class="col-md-6">
                                <input id="nama_ayah" type="text" class="form-control{{ $errors->has('nama_ayah') ? ' is-invalid' : '' }}" name="nama_ayah" value="{{ old('nama_ayah') }}" required autofocus>
                                @if ($errors->has('nama_ayah'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama_ayah') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Tempat Lahir Ayah') }}</label>
                            <div class="col-md-6">
                                <input id="tempat_lahir_ayah" type="text" class="form-control{{ $errors->has('tempat_lahir_ayah') ? ' is-invalid' : '' }}" name="tempat_lahir_ayah" value="{{ old('tempat_lahir_ayah') }}" required autofocus>
                                @if ($errors->has('tempat_lahir_ayah'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tempat_lahir_ayah') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>                    
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir Ayah') }}</label>
                            <div class="col-md-6">
                                <input id="tanggal_lahir_ayah" type="date" class="form-control{{ $errors->has('tanggal_lahir_ayah') ? ' is-invalid' : '' }}" name="tanggal_lahir_ayah" value="{{ old('tanggal_lahir_ayah') }}" required autofocus>
                                @if ($errors->has('tanggal_lahir_ayah'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tanggal_lahir_ayah') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>
                            <div class="col-md-6">
                                <textarea id="alamat_ayah" rows="3" class="form-control{{ $errors->has('alamat_ayah') ? ' is-invalid' : '' }}" name="alamat_ayah" value="{{ old('alamat_ayah') }}" autofocus></textarea>
                                @if ($errors->has('alamat_ayah'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('alamat_ayah') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Nomor HP Ayah') }}</label>
                            <div class="col-md-6">
                                <input id="nomor_hp_ayah" type="number" class="form-control{{ $errors->has('nomor_hp_ayah') ? ' is-invalid' : '' }}" name="nomor_hp_ayah" value="{{ old('nomor_hp_ayah') }}" required autofocus>
                                @if ($errors->has('nomor_hp_ayah'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nomor_hp_ayah') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Pekerjaan Ayah') }}</label>
                            <div class="col-md-6">
                                <input id="pekerjaan_ayah" type="text" class="form-control{{ $errors->has('pekerjaan_ayah') ? ' is-invalid' : '' }}" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" required autofocus>
                                @if ($errors->has('pekerjaan_ayah'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pekerjaan_ayah') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Penghasilan Ayah') }}</label>
                            <div class="col-md-6">
                                <input id="penghasilan_ayah" type="number" class="form-control{{ $errors->has('penghasilan_ayah') ? ' is-invalid' : '' }}" name="penghasilan_ayah" value="{{ old('penghasilan_ayah') }}" required autofocus>
                                @if ($errors->has('penghasilan_ayah'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('penghasilan_ayah') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Pekerjaan Sambilan Ayah') }}</label>
                            <div class="col-md-6">
                                <input id="pekerjaan_sambilan_ayah" type="text" class="form-control{{ $errors->has('pekerjaan_sambilan_ayah') ? ' is-invalid' : '' }}" name="pekerjaan_sambilan_ayah" value="{{ old('pekerjaan_sambilan_ayah') }}" required autofocus>
                                @if ($errors->has('pekerjaan_sambilan_ayah'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pekerjaan_sambilan_ayah') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Penghasilan Pekerjaan Sambilan Ayah') }}</label>
                            <div class="col-md-6">
                                <input id="penghasilan_sambilan_ayah" type="number" class="form-control{{ $errors->has('penghasilan_sambilan_ayah') ? ' is-invalid' : '' }}" name="penghasilan_sambilan_ayah" value="{{ old('penghasilan_sambilan_ayah') }}" required autofocus>
                                @if ($errors->has('penghasilan_sambilan_ayah'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('penghasilan_sambilan_ayah') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Nama ibu') }}</label>
                            <div class="col-md-6">
                                <input id="nama_ibu" type="text" class="form-control{{ $errors->has('nama_ibu') ? ' is-invalid' : '' }}" name="nama_ibu" value="{{ old('nama_ibu') }}" required autofocus>
                                @if ($errors->has('nama_ibu'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama_ibu') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Tempat Lahir ibu') }}</label>
                            <div class="col-md-6">
                                <input id="tempat_lahir_ibu" type="text" class="form-control{{ $errors->has('tempat_lahir_ibu') ? ' is-invalid' : '' }}" name="tempat_lahir_ibu" value="{{ old('tempat_lahir_ibu') }}" required autofocus>
                                @if ($errors->has('tempat_lahir_ibu'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tempat_lahir_ibu') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>                    
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir ibu') }}</label>
                            <div class="col-md-6">
                                <input id="tanggal_lahir_ibu" type="date" class="form-control{{ $errors->has('tanggal_lahir_ibu') ? ' is-invalid' : '' }}" name="tanggal_lahir_ibu" value="{{ old('tanggal_lahir_ibu') }}" required autofocus>
                                @if ($errors->has('tanggal_lahir_ibu'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tanggal_lahir_ibu') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>
                            <div class="col-md-6">
                                <textarea id="alamat_ibu" rows="3" class="form-control{{ $errors->has('alamat_ibu') ? ' is-invalid' : '' }}" name="alamat_ibu" value="{{ old('alamat_ibu') }}" autofocus></textarea>
                                @if ($errors->has('alamat_ibu'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('alamat_ibu') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Nomor HP ibu') }}</label>
                            <div class="col-md-6">
                                <input id="nomor_hp_ibu" type="number" class="form-control{{ $errors->has('nomor_hp_ibu') ? ' is-invalid' : '' }}" name="nomor_hp_ibu" value="{{ old('nomor_hp_ibu') }}" required autofocus>
                                @if ($errors->has('nomor_hp_ibu'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nomor_hp_ibu') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Pekerjaan ibu') }}</label>
                            <div class="col-md-6">
                                <input id="pekerjaan_ibu" type="text" class="form-control{{ $errors->has('pekerjaan_ibu') ? ' is-invalid' : '' }}" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" required autofocus>
                                @if ($errors->has('pekerjaan_ibu'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pekerjaan_ibu') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Penghasilan ibu') }}</label>
                            <div class="col-md-6">
                                <input id="penghasilan_ibu" type="number" class="form-control{{ $errors->has('penghasilan_ibu') ? ' is-invalid' : '' }}" name="penghasilan_ibu" value="{{ old('penghasilan_ibu') }}" required autofocus>
                                @if ($errors->has('penghasilan_ibu'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('penghasilan_ibu') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Pekerjaan Sambilan ibu') }}</label>
                            <div class="col-md-6">
                                <input id="pekerjaan_sambilan_ibu" type="text" class="form-control{{ $errors->has('pekerjaan_sambilan_ibu') ? ' is-invalid' : '' }}" name="pekerjaan_sambilan_ibu" value="{{ old('pekerjaan_sambilan_ibu') }}" required autofocus>
                                @if ($errors->has('pekerjaan_sambilan_ibu'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pekerjaan_sambilan_ibu') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Penghasilan Pekerjaan Sambilan ibu') }}</label>
                            <div class="col-md-6">
                                <input id="penghasilan_sambilan_ibu" type="number" class="form-control{{ $errors->has('penghasilan_sambilan_ibu') ? ' is-invalid' : '' }}" name="penghasilan_sambilan_ibu" value="{{ old('penghasilan_sambilan_ibu') }}" required autofocus>
                                @if ($errors->has('penghasilan_sambilan_ibu'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('penghasilan_sambilan_ibu') }}</strong>
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
</div>
@endsection
