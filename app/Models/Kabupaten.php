<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'kabupaten';
    protected $fillable = [
        'nama', 'slug', 'id_propinsi'
    ];

    protected $hidden = [];

    public function propinsi()
    {
        return $this->belongsTo(Propinsi::class, 'id_propinsi', 'id');
    }
}
