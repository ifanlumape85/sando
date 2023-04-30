<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';
    protected $fillable = [
        'nama', 'slug', 'id_kabupaten'
    ];

    protected $hidden = [];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten', 'id');
    }

    public function jumlahPemilih()
    {
        $item = Pemilih::join('kelurahan', 'pemilih.id_kelurahan', 'kelurahan.id')
            ->where('kelurahan.id_kecamatan', $this->id)->count();
        return $item;
    }
}
