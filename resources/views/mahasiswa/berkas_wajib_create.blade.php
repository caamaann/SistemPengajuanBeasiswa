@extends('template')

@section('content')
<br>
<div class="container-fluid">
	<div class="row justify-content-center">
	    <div class="col-md-8">
	        <div class="card">
	            <div class="card-header">{{ __('Upload Berkas Wajib ') }}</div>
	            <div class="card-body">
	                <form method="POST" action="{{ route('mahasiswa.berkas.wajib.store') }}" enctype="multipart/form-data">	                    
	                    @csrf	                    
	                    <div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('KTM') }}</label>
	                        <div class="col-md-6">
	                            <input id="file_ktm" type="file" name="file_ktm">
	                            @if ($errors->has('file_ktm'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('file_ktm') }}</strong>
	                            </span>
	                            @endif
	                        </div>
                    	</div>
                    	<div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Kartu Keluarga') }}</label>
	                        <div class="col-md-6">
	                            <input id="file_kk" type="file" name="file_kk">
	                            @if ($errors->has('file_kk'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('file_kk') }}</strong>
	                            </span>
	                            @endif
	                        </div>
                    	</div>
                    	<div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Transkrip Nilai') }}</label>
	                        <div class="col-md-6">
	                            <input id="file_transkrip_nilai" type="file" name="file_transkrip_nilai">
	                            @if ($errors->has('file_transkrip_nilai'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('file_transkrip_nilai') }}</strong>
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