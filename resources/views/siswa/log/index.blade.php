@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="mb-3">History pembayaran</h3>
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
                                    <th>Petugas</th>
                                    <th>Nisn</th>
                                    <th>Nama</th>
                                    <th>Tgl bayar</th>
                                    <th>Bulan dibayar</th>
                                    <th>Tahun dibayar</th>
                                    <th>Spp</th>
                                    <th>Jumlah bayar</th>
                                    {{-- <th colspan="2">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $s)
                                <tr>
                                    <td>{{ $s->name_petugas }}</td>
                                    <td>{{ $s->nisn }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->tgl_bayar }}</td>
                                    <td>{{ $s->bulan_dibayar }}</td>
                                    <td>{{ $s->tahun_dibayar }}</td>
                                    <td>{{ $s->tahun }}</td>
                                    <td>{{ $s->jumlah_bayar}}</td>
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