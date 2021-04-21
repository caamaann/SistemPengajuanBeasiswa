@extends('template')

@section('content')
<br>
<br>
<br>
<br>
<div class="container-fluid">
	<div class="row justify-content-center">
	    <div class="col-md-8">
	        <div class="card">
	            <!-- <div class="card-header">{{ __('Edit Data Mahasiswa') }}</div> -->
	            <div class="card-header-custom" style="margin-top: 8%; text-align: center;">
	            <h4 style="color: #646464; font-family: poppins;">Edit Data Mahasiswa</h4>
	            </div>
	            
	            <div class="col-md-9" style="margin: auto; margin-top: 4%;">
			            <h5 style="color: #646464;">Data Diri</h5>
			            <p style="font-size: 14px; color: #848482; font-style: normal;">Data yang diisikan di form ini bersifat pribadi dan tidak akan dapat diakses oleh pihak lain selain pihak yang bertanggungjawab dalam adminisitrasi beasiswa.</p>
	            </div>

	            <div class="card-body" style="margin-bottom: 10%;">

	                <form method="POST" action="{{ route('mahasiswa.update') }}" enctype="multipart/form-data">
	                    @method('PATCH')
	                    @csrf
	                    <div class="form-group row" style="margin-top: 2%;">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Nama Mahasiswa') }}</label>
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
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>
	                        <div class="col-md-6">
	                            <div class="form-check">
						          <input class="form-check-input" type="radio" name="gender" id="gender" value="l" {{ $mahasiswa->gender=="l" ? 'checked':''}}>
						          <label class="form-check-label">
						            Laki-laki
						          </label>
						        </div>
						        <div class="form-check">
						          <input class="form-check-input" type="radio" name="gender" id="gender" value="p" {{ $mahasiswa->gender=="p" ? 'checked':''}}>
						          <label class="form-check-label">
						            Perempuan
						          </label>
						        </div>
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Tempat Lahir') }}</label>
	                        <div class="col-md-6">
	                            <input id="tempat_lahir" type="text" class="form-control{{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}" name="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}" required autofocus>
	                            @if ($errors->has('tempat_lahir'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('tempat_lahir') }}</strong>
	                            </span>
	                            @endif
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>
	                        <div class="col-md-6">
	                            <input id="tanggal_lahir" type="date" class="form-control{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" name="tanggal_lahir" value="{{ $mahasiswa->tanggal_lahir }}" required autofocus>
	                            @if ($errors->has('tanggal_lahir'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('tanggal_lahir') }}</strong>
	                            </span>
	                            @endif
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>
	                        <div class="col-md-6">
	                            <textarea id="alamat" rows="3" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" autofocus>{{ $mahasiswa->alamat }}</textarea>
	                            @if ($errors->has('alamat'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('alamat') }}</strong>
	                            </span>
	                            @endif
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Kota') }}</label>
	                        <div class="col-md-6">
	                            <input id="kota" type="text" class="form-control{{ $errors->has('kota') ? ' is-invalid' : '' }}" name="kota" value="{{ $mahasiswa->kota }}" required autofocus>
	                            @if ($errors->has('kota'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('kota') }}</strong>
	                            </span>
	                            @endif
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Kode pos') }}</label>
	                        <div class="col-md-6">
	                            <input id="kode_pos" type="number" class="form-control{{ $errors->has('kode_pos') ? ' is-invalid' : '' }}" name="kode_pos" value="{{ $mahasiswa->kode_pos }}" required autofocus>
	                            @if ($errors->has('kode_pos'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('kode_pos') }}</strong>
	                            </span>
	                            @endif
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Nomor HP') }}</label>
	                        <div class="col-md-6">
	                            <input id="nomor_hp" type="number" class="form-control{{ $errors->has('nomor_hp') ? ' is-invalid' : '' }}" name="nomor_hp" value="{{ $mahasiswa->nomor_hp }}" required autofocus>
	                            @if ($errors->has('nomor_hp'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('nomor_hp') }}</strong>
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
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Nama Bank') }}</label>
	                        <div class="col-md-6">
	                            <input id="nama_bank" type="text" class="form-control{{ $errors->has('nama_bank') ? ' is-invalid' : '' }}" name="nama_bank" value="{{ $mahasiswa->nama_bank }}" required autofocus>
	                            @if ($errors->has('nama_bank'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('nama_bank') }}</strong>
	                            </span>
	                            @endif
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label class="col-md-4 col-form-label text-md-right">{{ __('Nomor Rekening') }}</label>
	                        <div class="col-md-6">
	                            <input id="nomor_rekening" type="number" class="form-control{{ $errors->has('nomor_rekening') ? ' is-invalid' : '' }}" name="nomor_rekening" value="{{ $mahasiswa->nomor_rekening }}" required autofocus>
	                            @if ($errors->has('nomor_rekening'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('nomor_rekening') }}</strong>
	                            </span>
	                            @endif
	                        </div>
	                    </div>
	                    {{-- <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Akhir Penerimaan') }}</label>
                        <div class="col-md-6">
                            <input id="sertifikat_ppkk" type="file" class="form-control{{ $errors->has('sertifikat_ppkk') ? ' is-invalid' : '' }}" name="sertifikat_ppkk" value="{{ $mahasiswa->sertifikat_ppkk }}" required autofocus>
                            @if ($errors->has('sertifikat_ppkk'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sertifikat_ppkk') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div> --}}
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
<br>
<br>
<br>
@endsection