<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    public function index(Request $request)
    {
        $items = Kelurahan::selectRaw('
            kelurahan.id,
            kelurahan.id_kecamatan,
            kelurahan.nama,
            kelurahan.slug,
            kelurahan.created_at,
            kelurahan.updated_at,
            (SELECT COUNT(pemilih.id) FROM pemilih WHERE pemilih.id_kelurahan=kelurahan.id) as jumlah_pemilih
        ')->where(function ($query) use ($request) {
            return $request->input('query') ?
                $query->where('nama', 'like', '%' . $request->input('query') . '%') : '';
        })->orderBy('id', 'desc')
            ->skip($request->input('start') ?? 0)
            ->take($request->input('limit') ?? 10)
            ->get();

        $response = [
            'message' => 'Sukses',
            'kelurahans' => $items->toArray()
        ];
        return response()->json($response, 200);
    }
}
