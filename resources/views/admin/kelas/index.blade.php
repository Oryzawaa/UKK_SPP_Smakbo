@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="mb-3">Data Kelas</h3>
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
                                <form action="{{route('admin.store.kelas')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <strong>Kelas</strong>
                                    <input type="text" name="name_kelas" class="form-control mb-3">
                                    <strong></strong>
                                    <strong>Kompetensi keahlian</strong>
                                    <input type="text" name="kompetensi_keahlian" class="form-control mb-3">
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
                                    <th>Kelas</th>
                                    <th>Kompetensi keahlian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kelas as $s)
                                <tr>
                                    <td>{{ $s->name_kelas }}</td>
                                    <td>{{ $s->kompetensi_keahlian}}</td>
                                    <td>
                                        <form action="{{ route('admin.destroy.kelas' , $s->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalUpdate{{ $s->id }}">Edit</button>
                                        </form>
                                        {{-- <div class="modal fade" id="modalUpdate{{ $s->id }} " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">   
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Update</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.update.kelas' , $s->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <strong>Kelas</strong>
                                                            <input type="number" name="name_kelas" id="" class="form-control mb-3" value="{{ $s->name_kelas }}">
                                                            <strong>Kompetensi keahlian</strong>
                                                            <input type="number" name="kompetensi_keahlian" id="" class="form-control mb-3" value="{{$s->kompetensi_keahlian }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="modal fade" id="modalUpdate{{ $s->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Ubah Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('admin.update.kelas', $s->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <strong>Kelas</strong>
                                                        <input type="text" name="name_kelas" id="" class="form-control mb-3" value="{{ $s->name_kelas }}">
                                                        <strong>Kompetensi keahlian</strong>
                                                        <input type="text" name="kompetensi_keahlian" id="" class="form-control mb-3" value="{{$s->kompetensi_keahlian }}">
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