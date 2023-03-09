<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Siswa , Kelas , Spp , User , Pembayaran , view_bayar};
use DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = DB::table('siswa')
        ->join('kelas' , 'siswa.id_kelas' , '=' , 'kelas.id')
        ->join('spp' , 'siswa.id_spp', '=' , 'spp.id')
        ->get();

        $kelas = Kelas::all();
        $spp = Spp::all();

        return view('admin.siswa.index' , compact('siswa' , 'kelas' , 'spp'));
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

        $siswa = Siswa::where('nisn' , '=' ,  $request->nisn)->first();
        $nis =  Siswa::where('nis' , '=' ,  $request->nis)->get();

        // dd($siswa);

        $request->validate([
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_spp' => 'required',
            'tahun_masuk' => 'required'
        ]);

        if($siswa)
        {
            return redirect()->route('admin.index.siswa')
            ->with('error' , 'Nisn / Nis sudah terdaftar');
        }
        else
        {
            Siswa::create([
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'id_spp' => $request->id_spp,
                'id_masuk' => $request->tahun_masuk
            ]);
    
            User::create([
                'username' => $request->nis,
                'name_petugas' =>$request->nama,
                'level' =>'siswa',
                'password' =>bcrypt($request->nis),
            ]);
    
    
            return redirect()->route('admin.index.siswa')
            ->with('success' , 'Data berhasil disimpan');
        }
    
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
    public function edit($siswa)
    {
        $siswa = Siswa::where('nisn' , $siswa)->first();
        $kelas = Kelas::all();
        $spp = Spp::all();

        return view('admin.siswa.edit' , compact('siswa' , 'kelas' , 'spp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nisn)
    {

        Siswa::where('nisn' , $nisn)->update([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_spp' => $request->id_spp,
            'id_masuk' => $request->id_masuk
            
        ]);

        User::where('username' , $nisn)->update([
            'username' =>   $request->nisn,
            'name_petugas' =>   $request->nama,
            'password' =>   $request->nisn,
            'level' =>   'siswa',

        ]);

        return redirect()->route('admin.index.siswa')
        ->with('success' , 'Data berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nisn)
    {
        Siswa::where('nisn' , $nisn)->delete();
        Pembayaran::where('nisn' , $nisn)->delete();
        User::where('username' , $nisn)->delete();
        // view_bayar::where('nisn' , $nisn)->delete();



        return redirect()->route('admin.index.siswa')
        ->with('success' , 'Data berhasil dihapus');
    }

}
