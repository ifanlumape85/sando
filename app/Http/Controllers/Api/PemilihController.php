<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemilih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class PemilihController extends Controller
{
    public function index(Request $request)
    {
        $items = Pemilih::with('kelurahan', 'tps')->where(function ($query) use ($request) {
            return $request->input('query') ?
                $query->where('nama', 'like', '%' . $request->input('query') . '%') : '';
        })->where(function ($query) use ($request) {
            return $request->input('query') ?
                $query->where('nik', 'like', '%' . $request->input('query') . '%') : '';
        })->orderBy('id', 'desc')
            ->skip($request->input('start') ?? 0)
            ->take($request->input('limit') ?? 10)
            ->get();

        $response = [
            'message' => 'Sukses',
            'pemilihs' => $items->toArray()
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'id_kelurahan' => ['sometimes', 'integer', 'exists:kelurahan,id'],
            // 'id_tps' => ['sometimes', 'integer', 'exists:tps,id'],
            // 'alamat' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'unique:pemilih,nik'],
            'nama' => ['required', 'string', 'max:255'],
            'jk' => ['required', 'string', 'max:255'],
            // 'tgl_lahir' => ['required', 'date'],
            'photo' => ['sometimes']
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => $validator->errors()->first()
            ];
            return response()->json($response, 200);
        }

        try {


            if ($request->photo) {
                $image = $request->photo;
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(60) . '.png';
                Storage::disk('local')->put('/public/assets/pemilih/' . $imageName, base64_decode($image));
                $pemilih = [
                    'id_kelurahan' => $request->id_kelurahan,
                    'id_tps' => $request->id_tps,
                    'alamat' => $request->alamat,
                    'nik' => $request->nik,
                    'nama' => $request->nama,
                    'jk' => $request->jk,
                    'tgl_lahir' => $request->tgl_lahir,
                    'photo' => 'assets/pemilih/' . $imageName
                ];
            } else {
                $pemilih = [
                    'id_kelurahan' => $request->id_kelurahan,
                    'id_tps' => $request->id_tps,
                    'alamat' => $request->alamat,
                    'nik' => $request->nik,
                    'nama' => $request->nama,
                    'jk' => $request->jk,
                    'tgl_lahir' => $request->tgl_lahir,
                ];
            }

            $createPemilih = Pemilih::create($pemilih);

            $response = [
                'pemilihs' => $createPemilih,
                'status' => true,
                'message' => 'success'
            ];


            return response()->json($response, 201);
        } catch (QueryException $e) {
            $error = "";
            if (is_array($e->errorInfo)) {
                foreach ($e->errorInfo as $f) {
                    $error .= $f . " ";
                }
            } else {
                $error = $e->errorInfo;
            }
            $response = [
                'status' => false,
                'message' => 'Failed. ' . $error
            ];
            return response()->json($response);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:pemilih,id'],
            // 'id_kelurahan' => ['sometimes', 'integer', 'exists:kelurahan,id'],
            // 'id_tps' => ['sometimes', 'integer', 'exists:tps,id'],
            // 'alamat' => ['sometimes', 'string', 'max:255'],
            'nik' => ['required', 'string', 'unique:pemilih,nik,' . $request->id],
            'nama' => ['required', 'string', 'max:255'],
            'jk' => ['required', 'string', 'max:255'],
            // 'tgl_lahir' => ['required', 'date'],
            'photo' => ['sometimes']
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => $validator->errors()->first()
            ];
            return response()->json($response, 200);
        }

        try {


            $pemilih = Pemilih::findOrFail($request->id);

            if ($request->photo) {
                $image = $request->photo;
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(60) . '.png';
                Storage::disk('local')->put('/public/assets/pemilih/' . $imageName, base64_decode($image));

                $pemilih->id_kelurahan = $request->id_kelurahan;
                $pemilih->id_tps = $request->id_tps;
                $pemilih->alamat = $request->alamat;
                $pemilih->nik = $request->nik;
                $pemilih->nama = $request->nama;
                $pemilih->jk = $request->jk;
                $pemilih->tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
                $pemilih->photo = 'assets/pemilih/' . $imageName;
            } else {
                $pemilih->id_kelurahan = $request->id_kelurahan;
                $pemilih->id_tps = $request->id_tps;
                $pemilih->alamat = $request->alamat;
                $pemilih->nik = $request->nik;
                $pemilih->nama = $request->nama;
                $pemilih->jk = $request->jk;
                $pemilih->tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
            }

            $pemilih->update();

            $response = [
                'status' => true,
                'message' => 'success'
            ];


            return response()->json($response, 201);
        } catch (QueryException $e) {
            $error = "";
            if (is_array($e->errorInfo)) {
                foreach ($e->errorInfo as $f) {
                    $error .= $f . " ";
                }
            } else {
                $error = $e->errorInfo;
            }
            $response = [
                'status' => false,
                'message' => 'Failed. ' . $error
            ];
            return response()->json($response);
        }
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:pemilih,id']
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => $validator->errors()->first()
            ];
            return response()->json($response, 200);
        }

        try {

            $item = Pemilih::findOrFail($request->id);
            Storage::delete($item->photo);
            $item->delete();

            $response = [
                'status' => true,
                'message' => 'success'
            ];


            return response()->json($response, 201);
        } catch (QueryException $e) {
            $error = "";
            if (is_array($e->errorInfo)) {
                foreach ($e->errorInfo as $f) {
                    $error .= $f . " ";
                }
            } else {
                $error = $e->errorInfo;
            }
            $response = [
                'status' => false,
                'message' => 'Failed. ' . $error
            ];
            return response()->json($response);
        }
    }
}
