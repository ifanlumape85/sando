<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KecamatanController extends Controller
{
    public function index(Request $request)
    {
        $items = Kecamatan::selectRaw('
            kecamatan.id,
            kecamatan.id_kabupaten,
            kecamatan.nama,
            kecamatan.slug,
            kecamatan.created_at,
            kecamatan.updated_at,
            (SELECT COUNT(pemilih.id) FROM pemilih LEFT JOIN kelurahan ON pemilih.id_kelurahan=kelurahan.id WHERE kelurahan.id_kecamatan=kecamatan.id) AS jumlah_pemilih
        ')
            ->where(function ($query) use ($request) {
                return $request->input('query') ?
                    $query->where('kecamatan.nama', 'like', '%' . $request->input('query') . '%') : '';
            })
            ->orderBy('id', 'desc')
            ->skip($request->input('start') ?? 0)
            ->take($request->input('limit') ?? 10)
            ->get();

        $response = [
            'message' => 'Sukses',
            'kecamatans' => $items->toArray()
        ];

        return response()->json($response, 200);
    }
}
