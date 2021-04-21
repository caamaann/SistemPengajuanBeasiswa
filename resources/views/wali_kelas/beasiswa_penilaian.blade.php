@extends('template')
@section('content')
<br>
<div class="container-fluid">
@if($sertifikatMahasiswa->list_sertifikat_organisasi)
    <p>Sertifikat Organisasi</p>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Jenis</th>
              <th>Gambar</th>
            </tr>       
          </thead>
          <tbody>
            @foreach($sertifikatMahasiswa->list_sertifikat_organisasi as $key => $sertifikat)        
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $sertifikat->jenis }}</td>
                <td><img src="{{ \Config::get('constants.sertifikat_organisasi_path').$sertifikat->file_sertifikat }}" width="100px"></td>                
            </tr>                   
            @endforeach
          </tbody>
        </table>
    </div>  
@else    
    <div class="alert alert-danger col-md-12">
        <p>Mahasiswa ini tidak memiliki sertifikat organisasi</p>
    </div>    
@endif

@if($sertifikatMahasiswa->list_sertifikat_prestasi)
<div class="table-responsive">
    <p>Sertifikat Prestasi</p>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Tingkat Prestasi</th>
          <th>Gambar</th>                       
        </tr>       
      </thead>
      <tbody>
        @foreach($sertifikatMahasiswa->list_sertifikat_prestasi as $key => $sertifikat)        
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $sertifikat->tingkat_prestasi }}</td>
            <td><img src="{{ \Config::get('constants.sertifikat_prestasi_path').$sertifikat->file_sertifikat }}" width="100px"></td>            
        </tr>                   
        @endforeach
      </tbody>
    </table>
</div>  
@else    
    <div class="alert alert-danger col-md-12">
        <p>Mahasiswa ini tidak memiliki sertifikat prestasi</p>
    </div>    
@endif
<div class="row justify-content-center">    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Penilaian Kelayakan') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('wali_kelas.beasiswa.penilaian.submit', [$beasiswa_id, $nim]) }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Skor Prestasi') }}</label>
                        <div class="col-md-6">
                            <input id="skor_prestasi" type="number" min="0" class="form-control{{ $errors->has('skor_prestasi') ? ' is-invalid' : '' }}" name="skor_prestasi" value="{{ old('skor_prestasi') }}" required autofocus>
                            @if ($errors->has('skor_prestasi'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('skor_prestasi') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Skor Perilaku') }}</label>
                        <div class="col-md-6">
                            <input id="skor_perilaku" type="number" min="0" class="form-control{{ $errors->has('skor_perilaku') ? ' is-invalid' : '' }}" name="skor_perilaku" value="{{ old('skor_perilaku') }}" required autofocus>
                            @if ($errors->has('skor_perilaku'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('skor_perilaku') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Skor Organisasi') }}</label>
                        <div class="col-md-6">
                            <input id="skor_organisasi" type="number" min="0" class="form-control{{ $errors->has('skor_organisasi') ? ' is-invalid' : '' }}" name="skor_organisasi" value="{{ old('skor_organisasi') }}" required autofocus>
                            @if ($errors->has('skor_organisasi'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('skor_organisasi') }}</strong>
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