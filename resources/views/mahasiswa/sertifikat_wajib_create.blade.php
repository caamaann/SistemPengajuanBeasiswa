@extends('template')

@section('content')
<br>
<div class="container-fluid">
	<div class="row justify-content-center">
	    <div class="col-md-8">
	        <div class="card">
	            <div class="card-header">{{ __('Edit Data Mahasiswa') }}</div>
	            <div class="card-body">
	                <form method="POST" action="{{ route('mahasiswa.sertifikat.wajib.store') }}" enctype="multipart/form-data">	                    
	                    @csrf	                    
	                    <div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Sertifikat PPKK') }}</label>
	                        <div class="col-md-6">
	                            <input id="sertifikat_ppkk" type="file" name="sertifikat_ppkk">
	                            @if ($errors->has('sertifikat_ppkk'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('sertifikat_ppkk') }}</strong>
	                            </span>
	                            @endif
	                        </div>
                    	</div>
                    	<div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Sertifikat Bela Negara') }}</label>
	                        <div class="col-md-6">
	                            <input id="sertifikat_bn" type="file" name="sertifikat_bn">
	                            @if ($errors->has('sertifikat_bn'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('sertifikat_bn') }}</strong>
	                            </span>
	                            @endif
	                        </div>
                    	</div>
                    	<div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Sertifikat ESQ') }}</label>
	                        <div class="col-md-6">
	                            <input id="sertifikat_esq" type="file" name="sertifikat_esq">
	                            @if ($errors->has('sertifikat_esq'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('sertifikat_esq') }}</strong>
	                            </span>
	                            @endif
	                        </div>
                    	</div>
                    	<div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Sertifikat Metagama') }}</label>
	                        <div class="col-md-6">
	                            <input id="sertifikat_metagama" type="file" name="sertifikat_metagama">
	                            @if ($errors->has('sertifikat_metagama'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('sertifikat_metagama') }}</strong>
	                            </span>
	                            @endif
	                        </div>
                    	</div>
                    	<div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Sertifikat Butterfly') }}</label>
	                        <div class="col-md-6">
	                            <input id="sertifikat_butterfly" type="file" name="sertifikat_butterfly">
	                            @if ($errors->has('sertifikat_butterfly'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('sertifikat_butterfly') }}</strong>
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