@extends('template')

@section('content')
<br>
<div class="container-fluid">
    <p>Kuota beasiswa {{ $kuotaBeasiswa->nama }}</p>
    <a href="{{ route('pembantu_direktur_3.beasiswa.kuota.create', $kuotaBeasiswa->id) }}" class="btn btn-primary">Insert Kuota</a>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Program Studi</th>
                    <th>Angkatan</th>
                    <th>Kuota</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kuotaBeasiswa->program_studi as $key => $kuotaProgramStudi)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $kuotaProgramStudi->nama }}</td>
                    <td>{{ $kuotaProgramStudi->pivot->angkatan }}</td>
                    <td>{{ $kuotaProgramStudi->pivot->kuota }}</td>
                    <td>
                        <a href="{{ route('pembantu_direktur_3.beasiswa.kuota.edit', [$kuotaBeasiswa->id, $kuotaProgramStudi->id, $kuotaProgramStudi->pivot->angkatan]) }}" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('pembantu_direktur_3.beasiswa.kuota.destroy', [$kuotaBeasiswa->id, $kuotaProgramStudi->id, $kuotaProgramStudi->pivot->angkatan]) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>                    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection