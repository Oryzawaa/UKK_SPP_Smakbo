@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="mb-3">Data Pembayaran</h3>
                    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal">
                        Tambah Data
                    </button>
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
                                    {{-- <td>
                                        <form action="{{ route('admin.destroy.pembayaran' , $s->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $s->id }}" class="btn btn-warning">Edit</a>
                                    </td>
                                        </form> --}}
                                        {{-- <div class="modal fade" id="modalUpdate{{ $s->id}} " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">   
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Update</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.update.siswa' , $s->nisn)}}" method="POST">
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
            <form action="{{route('petugas.store.pembayaran')}}" method="POST">
            @csrf
            <div class="form-group">
                <strong>Siswa</strong>
                <select name="nisn" id="nisn" class="form-control mb-3" style="width : 100%;">
                    <option value="" selected disabled>Pilih Siswa</option>
                    @foreach($siswa as $s)
                    <option value="{{ $s->nisn }}">Nisn : {{ $s->nisn}} | Nama : {{ $s->nama }} | Spp - Rp. {{ number_format($s->nominal)}}</option>
                    @endforeach
                </select>
                <br><br>
                <div class="form-group">
                    <label for="berapa">Bayar Berapa Bulan</label>
                    <select name="bayar_berapa" id="berapa" class="form-control">
                        <option value="1">1 Bulan</option>
                        <option value="2">2 Bulan</option>
                        <option value="3">3 Bulan</option>
                        <option value="4">4 Bulan</option>
                        <option value="5">5 Bulan</option>
                        <option value="6">6 Bulan</option>
                        <option value="7">7 Bulan</option>
                        <option value="8">8 Bulan</option>
                        <option value="9">9 Bulan</option>
                        <option value="10">10 Bulan</option>
                        <option value="11">11 Bulan</option>
                        <option value="12">12 Bulan</option>
                    </select>
                </div>
                <input type="hidden" name="" id="spp" readonly placeholder="Nominal SPP">
                <input type="hidden" name="name_kelas" id="kelas">
                <input type="hidden" name="nis" id="nis">
                <input type="hidden" name="alamat" id="alamat">
                <input type="hidden" name="no_telp" id="no_telp">
                <input type="hidden" name="nama" id="nama">
                <strong>Terakhir bayar</strong>
                <input type="text" name="akhir" id="akhir" class="form-control mb-3" readonly>
                <strong>Nominal</strong>
                <input type="text" name="nominal" id="nominal" class="form-control mb-3" readonly>
                <strong>Uang</strong>
                <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control mb-3">
                <strong>Kembalian</strong>
                <input type="number" name="" id="kembalian" class="form-control mb-3" readonly>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        $('#table').DataTable();
    });
</script>

<script>
    $(document).ready(function (){
        $('#nisn').select2();
    })
</script>

<script>
    $('#nisn').on('change', function(){
        var nisn = $('#nisn').val();
        var berapa = $('#berapa').val();
        $('#trk').removeClass('d-none');
        $.ajax({
            url: "{{url('pembayaran/getdata/')}}" + "/" + nisn + "/" + berapa,
            type: "GET",
            dataType: "json",
            success: function (datas) {
                console.log(datas);
                $('#spp').val(datas['nominal']);
                $('#akhir').val(datas['bulan']);
                $('#kelas').val(datas['kelas']);
                $('#alamat').val(datas['alamat']);
                $('#no_telp').val(datas['no_telp']);
                $('#nis').val(datas['nis']);
                $('#nama').val(datas['nama']);
            }
        });

         $('#berapa').on('change', function () {
            var spp = $('#spp').val();
            var bayar = $(this).val();
            var total = spp * bayar;
            $('#nominal').val(total);

        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#nominal, #jumlah_bayar").keyup(function() {
            var harga  = $("#nominal").val();
            var jumlah = $("#jumlah_bayar").val();

            var total = parseInt(jumlah) - parseInt(harga);
            $("#kembalian").val(total);
        });
    });
</script>

<script>
    $('#jumlah_bayar').keyup(function(){
        var sanitized = $(this).val().replace(/[^0-9]/g, '');

        $(this).val(sanitized);
    });
</script>



@endsection