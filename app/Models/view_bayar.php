<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class view_bayar extends Model
{
    use HasFactory;
    protected $table = 'view_bayar';
    protected $fillable = [
        'name_petugas',
        'nisn',
        'nis',
        'nama',
        'kelas',
        'alamat',
        'no_telp',
        'tgl_bayar',
        'bulan_dibayar',
        'tahun_dibayar',
        'jumlah_bayar'    
    ];
}
