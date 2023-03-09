<?php

namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\{Kelas , Spp  , Siswa , Pembayaran , view_bayar};
use Carbon\Carbon;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('pembayaran')
        ->join('siswa' , 'pembayaran.nisn' , '=' , 'siswa.nisn')
        ->join('users' , 'pembayaran.id_petugas' , '=' , 'users.id')
        ->join('spp' , 'pembayaran.id_spp' , '=' , 'spp.id')
        ->get();

        $siswa = DB::table('siswa')
        ->join('spp' , 'siswa.id_spp' , '=' , 'spp.id')
        ->get();

        return view('petugas.pembayaran.index' , compact('data' , 'siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nisn' => 'required|numeric',
            'jumlah_bayar' => 'required|numeric',
        ]);


        // dd($request->bayar_berapa);
        for ($i = 0; $i < $request->bayar_berapa; $i++) {
            $bulan = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];

            $siswa = Siswa::where('nisn', '=', $request->nisn)->first();
            $spp = Spp::where('id', '=', $siswa->id_spp)->first();
            $pembayaran = Pembayaran::where('nisn', '=', $siswa->nisn)->get();
            $bapa = Pembayaran::where('nisn' , $request->nisn)->count();
            $max = 36 - $bapa;
            // $ibu = $siswa->id_masuk - $bapa;
    

            if ($pembayaran->isEmpty()) {
                $bln = 6;
                $tahun = substr($spp->tahun, 0, 4);
            } else {
                $pembayaran = Pembayaran::where('nisn', '=', $siswa->nisn)
                    ->orderBy('id', 'Desc')->latest()
                    ->first();

                $bln = array_search($pembayaran->bulan_dibayar, $bulan);

                if ($bln == 11) {
                    $bln = 0;
                    $tahun = $pembayaran->tahun_dibayar + 1;
                } else {
                    $bln = $bln + 1;
                    $tahun = $pembayaran->tahun_dibayar;
                }

                if ($max == 0) {
                    return back()->with('error', 'Sudah lunas');
                }

                // if ($ibu == 0)
                // {
                //     return back()->with('error', 'Sudah lunas');   
                // }
            }

            if ($request->jumlah_bayar < $spp->nominal) {
                return back()->with('error', 'Uang yang dimasukan tidak sesuai');
            }

            $pembayaranSimpan = Pembayaran::create([
                'id_petugas' => auth()->user()->id,
                'nisn' => $request->nisn,
                'tgl_bayar' => Carbon::now(),
                'bulan_dibayar' => $bulan[$bln],
                'tahun_dibayar' => $tahun,
                'id_spp' => $spp->id,
                'jumlah_bayar' => $request->jumlah_bayar 
            ]);

            view_bayar::create([
                'name_petugas' => auth()->user()->name_petugas,
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'kelas' => $request->name_kelas,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'tgl_bayar' => Carbon::now(),
                'bulan_dibayar' => $bulan[$bln],
                'tahun_dibayar' => $tahun,
                'jumlah_bayar' => $request->jumlah_bayar 
            ]);

        }

        if ($pembayaranSimpan) {
            return redirect()->route('petugas.index.pembayaran')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'data gagal masuk');
        }
    }

    public function getData($nisn , $berapa)
    {
        $siswa = Siswa::where('nisn', '=', $nisn)->first();
        $spp = Spp::where('id', '=', $siswa->id_spp)->first();
        $kelas = Kelas::where('id' , '=' , $siswa->id_kelas)->first();

        $pembayaran = Pembayaran::where('nisn', '=', $nisn)
            ->orderBy('id', 'Desc')->latest()
            ->first();
        
        $bapa = Pembayaran::where('nisn', '=', $nisn)->count();
        $max = 36 - $bapa;
        $ibu = $siswa->id_masuk - $bapa;

        if ($pembayaran == null) {
            $data = [
                'nominal' => $spp->nominal * $berapa,
                'bulan' => 'belum pernah bayar',
                'tahun' => '',  
                'kelas' => $kelas->name_kelas,
                'nama' => $siswa->nama,
                'nis' => $siswa->nis,
                'alamat' => $siswa->alamat,
                'no_telp' => $siswa->no_telp
            ];
        } else {

            if ($max == 0) {
                $data = [
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => 'Sudah lunas',
                    'tahun' => '',
                    'kelas' => $kelas->name_kelas,
                    'nama' => $siswa->nama,
                    'nis' => $siswa->nis,
                    'alamat' => $siswa->alamat,
                    'no_telp' => $siswa->no_telp
                ];
            // }if ($ibu == 0) {
            //     $data = [
            //         'nominal' => $spp->nominal * $berapa,
            //         'bulan' => 'Sudah lunas',
            //         'tahun' => '',
            //         'kelas' => $kelas->name_kelas,
            //         'nama' => $siswa->nama,
            //         'nis' => $siswa->nis,
            //         'alamat' => $siswa->alamat,
            //         'no_telp' => $siswa->no_telp
            //     ];
            } else {
                $data = [
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => $pembayaran->bulan_dibayar,
                    'tahun' => $pembayaran->tahun_dibayar,
                    'kelas' => $kelas->name_kelas,
                    'nama' => $siswa->nama,
                    'nis' => $siswa->nis,
                    'alamat' => $siswa->alamat,
                    'no_telp' => $siswa->no_telp
                ];
            }
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
