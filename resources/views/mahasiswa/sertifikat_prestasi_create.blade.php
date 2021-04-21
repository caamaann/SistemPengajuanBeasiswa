@extends('template')

@section('content')
<br>
<div class="container-fluid">
	<div class="row justify-content-center">
	    <div class="col-md-8">
	        <div class="card">
	            <div class="card-header">{{ __('Tambah Sertifikat Prestasi') }}</div>
	            <div class="card-body">
	                <form method="POST" action="{{ route('mahasiswa.sertifikat.prestasi.store') }}" enctype="multipart/form-data">	                    
	                    @csrf	                    
	                    <div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Sertifikat Prestasi') }}</label>
	                        <div class="col-md-6">
	                            <input id="file_sertifikat" type="file" name="file_sertifikat" required="">
	                            @if ($errors->has('file_sertifikat'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('file_sertifikat') }}</strong>
	                            </span>
	                            @endif
	                        </div>
                    	</div>
                    	<div class="form-group row">                    		
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Tingkat Prestasi') }}</label>
	                        <div class="col-md-6">
	                            <div class="form-check">
						          <input class="form-check-input" type="radio" name="tingkat_prestasi" value="Internasional">
						          <label class="form-check-label">
						            Internasional
						          </label>
						        </div>
						        <div class="form-check">
						          <input class="form-check-input" type="radio" name="tingkat_prestasi" value="Nasional">
						          <label class="form-check-label">
						            Nasional
						          </label>
						        </div>
						        <div class="form-check">
						          <input class="form-check-input" type="radio" name="tingkat_prestasi" value="Provinsi">
						          <label class="form-check-label">
						            Provinsi
						          </label>
						        </div>
						        <div class="form-check">
						          <input class="form-check-input" type="radio" name="tingkat_prestasi" value="Kota">
						          <label class="form-check-label">
						            Kota/Kabupaten
						          </label>
						        </div>
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