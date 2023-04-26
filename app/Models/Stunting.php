<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stunting extends Model
{
    use HasFactory;
    protected $table = 'stunting';
    protected $fillable = [
        'id_balita', 'tahun', 'bulan', 'hari', 'tgl_pengukuran', 'berat', 'tinggi', 'lila', 'bb_per_u', 'zs_bb_per_u',
        'tb_per_u', 'zs_tb_per_u', 'bb_per_tb', 'zs_bb_per_tb', 'naik_berat_badan', 'pmt_diterima', 'jml_vit_a', 'kpsp', 'kia'
    ];

    protected $hidden = [];

    public function balita()
    {
        return $this->belongsTo(Balita::class, 'id_balita', 'id');
    }
}
