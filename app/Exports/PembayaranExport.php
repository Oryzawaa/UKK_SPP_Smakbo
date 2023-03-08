<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\view_bayar;
use Maatwebsite\Excel\Concerns\WithUpserts;
use DB;

class PembayaranExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return view_bayar::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'Petugas', 
            'nisn',
            'nis',
            'nama siswa',
            'kelas',
            'alamat',
            'no_telp',
            'tgl_bayar' ,
            'bulan_dibayar',
            'tahun_dibayar',
            'jumlah_bayar',
            'created_at',
            'updated_at',
        ];
    }
}
