<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilih extends Model
{
    use HasFactory;
    protected $table = 'pemilih';

    protected $fillable = [
        'id_tps', 'alamat', 'nik', 'nama', 'jk', 'tgl_lahir', 'photo'
    ];

    protected $hidden = [];


    public function tps()
    {
        return $this->belongsTo(Tps::class, 'id_tps', 'id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id');
    }
}
