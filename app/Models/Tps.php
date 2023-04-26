<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Tps extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'tps';
    protected $fillable = [
        'nama', 'slug', 'id_kelurahan'
    ];

    protected $hidden = [];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id');
    }
}
