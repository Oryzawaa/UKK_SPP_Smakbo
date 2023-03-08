@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="mb-3">Edit Siswa</h3>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                    <p>{{ $message }}</p>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                    </div>
                    @endif
                    <div>
                        <form action="{{route('admin.update.siswa', $siswa->nisn)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <strong>Nisn</strong>
                            <input type="number" name="nisn" class="form-control mb-3" value="{{ $siswa->nisn }}">
                            <strong>Nis</strong>
                            <input type="number" name="nis" class="form-control mb-3" value="{{ $siswa->nis }}">
                            <strong>Nama</strong>
                            <input type="text" name="nama" class="form-control mb-3" value="{{ $siswa->nama }}">
                            <strong>No Telp</strong>
                            <input type="number" name="no_telp" class="form-control mb-3" value="{{ $siswa->no_telp }}">
                            <strong>Alamat</strong>
                            <input name="alamat" id="" cols="30" rows="10" class="form-control mb-3" value="{{ $siswa->alamat }}">
                            <strong>Kelas</strong>
                            <select name="id_kelas" id="id_kelas" class="form-control mb-3">
                                @foreach($kelas as $s)
                                <option value="{{ $siswa->id_kelas }}" {{($siswa->id_kelas == $s->id) ? 'selected' : ''}} >{{ $s->name_kelas }}</option>
                                @endforeach
                            </select>
                            <strong>SPP</strong>
                            <select name="id_spp" id="id_spp" class="form-control mb-3">
                                @foreach($spp as $t)
                                <option value="{{ $siswa->id_spp }}" {{($siswa->id_spp == $t->id) ? 'selected' : ''}} >{{ $t->tahun }}</option>
                                @endforeach
                            </select>
                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#table').DataTable();
    });
</script>
@endsection