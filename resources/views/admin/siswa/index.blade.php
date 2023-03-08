@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="mb-3">Data Siswa</h3>
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal">
                        Tambah Data
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin.store.siswa')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <strong>Nisn</strong>
                                    <input type="number" name="nisn" class="form-control mb-3">
                                    <strong>Nis</strong>
                                    <input type="number" name="nis" class="form-control mb-3">
                                    <strong>Nama</strong>
                                    <input type="text" name="nama" class="form-control mb-3">
                                    <strong>Kelas</strong>
                                    <select name="id_kelas" id="id_kelas" class="form-control mb-3">
                                        <option value="" selected disabled>--Pilih Kelas--</option>
                                        @foreach( $kelas as $p)
                                        <option value="{{ $p->id }}">{{ $p->name_kelas }}</option>
                                        @endforeach
                                    </select>
                                    <strong>Alamat</strong>
                                    <textarea name="alamat" id="" cols="30" rows="10" class="form-control mb-3"></textarea>
                                    <strong>No Telp</strong>
                                    <input type="number" name="no_telp" class="form-control mb-3">
                                    <strong>SPP</strong>
                                    <select name="id_spp" id="id_spp" class="form-control mb-3">
                                        <option value="" selected disabled>--Pilih SPP--</option>
                                        @foreach( $spp as $t)
                                        <option value="{{ $t->id }}">{{ $t->tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    
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
                        <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>Nisn</th>
                                    <th>Nis</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                    <th>Spp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswa as $s)
                                <tr>
                                    <td>{{ $s->nisn }}</td>
                                    <td>{{ $s->nis }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->name_kelas }}</td>
                                    <td>{{ $s->alamat }}</td>
                                    <td>{{ $s->no_telp }}</td>
                                    <td>{{ $s->tahun }}</td>
                                    <td>
                                        <form action="{{ route('admin.destroy.siswa' , $s->nisn) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalUpdate{{ $s->nisn }}">Edit</button>
                                        </form>
                                        <div class="modal fade" id="modalUpdate{{ $s->nisn }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Ubah Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('admin.update.siswa', $s->nisn)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <strong>Nisn</strong>
                                                        <input type="number" name="nisn" class="form-control mb-3" value="{{ $s->nisn }}">
                                                        <strong>Nis</strong>
                                                        <input type="number" name="nis" class="form-control mb-3" value="{{ $s->nis }}">
                                                        <strong>Nama</strong>
                                                        <input type="text" name="nama" class="form-control mb-3" value="{{ $s->nama }}">
                                                        <strong>No Telp</strong>
                                                        <input type="text" name="no_telp" class="form-control mb-3" value="{{ $s->no_telp }}">
                                                        <strong>Alamat</strong>
                                                        <input name="alamat" id="" cols="30" rows="10" class="form-control mb-3" value="{{ $s->alamat }}">
                                                        <strong>Kelas</strong>
                                                        <select name="id_kelas" id="id_kelas" class="form-control mb-3">
                                                            @foreach($kelas as $s)
                                                            <option value="{{ $s->id_kelas }}" {{($s->id_kelas == $s->id) ? 'selected' : ''}} >{{ $s->name_kelas }}</option>
                                                            @endforeach
                                                        </select>
                                                        <strong>SPP</strong>
                                                        <select name="id_spp" id="id_spp" class="form-control mb-3">
                                                            @foreach($spp as $t)
                                                            <option value="{{ $t->id_spp }}" {{($t->id_spp == $t->id) ? 'selected' : ''}} >{{ $t->tahun }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>                                        
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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