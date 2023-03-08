<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Siswa , Kelas , Spp , User};
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

        $siswa = Siswa::where('nisn' , '=' ,  $request->nisn)->get();
        $nis =  Siswa::where('nisn' , '=' ,  $request->nis)->get();

        // dd($siswa);

        $request->validate([
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_spp' => 'required',
        ]);

        if($request->nisn == $siswa)
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
        $request->validate([
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'id_kelas   ' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_spp' => 'required',
        ]);

        // dd($nisn);

        Siswa::where('nisn' , $nisn)->update([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_spp' => $request->id_spp,
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

        return redirect()->route('admin.index.siswa')
        ->with('success' , 'Data berhasil dihapus');
    }
}
