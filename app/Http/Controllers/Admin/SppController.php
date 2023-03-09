<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Spp};

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spp = Spp::all();

        return view('admin.spp.index' , compact('spp'));
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
        $request->validate([
            'tahun' => 'required',
            'nominal' => 'required'
        ]);

        $spp = Spp::where('tahun' , $request->tahun)->first();

        if($spp)
        {
            return redirect()->route('admin.index.spp')
            ->with('error' , 'Spp sudah ada!!');
        }else
        {
            Spp::create([
                'tahun' => $request->tahun,
                'nominal' => $request->nominal,
                'total_bulan' => $request->total_bulan
            ]);
    
            return redirect()->route('admin.index.spp')
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
        $request->validate([
            'tahun' => 'required',
            'nominal' => 'required'
        ]);

        Spp::where('id' , $id)->update([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        return redirect()->route('admin.index.spp')
        ->with('success' , 'Data berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Spp::where('id' , $id)->delete();
        
        return redirect()->route('admin.index.spp')
        ->with('success' , 'Data berhasil dihapus');
    }
}
