<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tps;
use Illuminate\Http\Request;

class TpsController extends Controller
{
    public function index(Request $request)
    {
        $items = Tps::where(function ($query) use ($request) {
            return $request->input('query') ?
                $query->where('nama', 'like', '%' . $request->input('query') . '%') : '';
        })->orderBy('id', 'desc')
            ->skip($request->input('start') ?? 0)
            ->take($request->input('limit') ?? 10)
            ->get();

        $response = [
            'message' => 'Sukses',
            'tpss' => $items->toArray()
        ];
        return response()->json($response, 200);
    }
}
