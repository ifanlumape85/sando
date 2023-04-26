<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KecamatanRequest;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Propinsi;
use App\Models\Usia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class KelurahanController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:kelurahan-list|kelurahan-create|kelurahan-edit|kelurahan-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:kelurahan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kelurahan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kelurahan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.kelurahan.index');
    }

    public function getData()
    {
        $items = Kelurahan::select(['kelurahan.id', 'kelurahan.created_at', 'kelurahan.nama', 'kecamatan.nama as kecamatan', 'kabupaten.nama as kabupaten', 'propinsi.nama as propinsi'])
            ->join('kecamatan', 'kelurahan.id_kecamatan', '=', 'kecamatan.id')
            ->join('kabupaten', 'kecamatan.id_kabupaten', '=', 'kabupaten.id')
            ->join('propinsi', 'kabupaten.id_propinsi', '=', 'propinsi.id')
            ->orderBy('kelurahan.id', 'desc');

        return DataTables::of($items)
            ->addColumn('action', function ($row) {
                $btn = '<a href="/admin/kelurahan/' . $row->id . '/edit" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $row->id . "'" . ')" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
                return $btn;
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at ? with(new Carbon($row->created_at))->format('m/d/Y') : '';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Kelurahan();
        $propinsis = Propinsi::all();
        return view('pages.kelurahan.create', compact('item', 'propinsis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KecamatanRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);
        Kelurahan::create($data);
        session()->flash('success', 'Item was created.');
        return redirect()->route('kelurahan.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Kelurahan::findOrFail($id);
        $propinsis = Propinsi::all();
        return view('pages.kelurahan.edit', compact('item', 'propinsis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KecamatanRequest $request, $id)
    {
        $data = $request->all();
        $item = Kelurahan::findOrFail($id);
        $data['slug'] = Str::slug($request->nama);
        $item->update($data);
        session()->flash('success', 'Item was updated.');
        return redirect()->route('kelurahan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Kelurahan::findOrFail($id);
        $item->delete();
        return response()->json(['success' => 'Item deleted successfully']);
    }

    public function getList($id)
    {
        $items = Kelurahan::where('id_kecamatan', $id)->get();
        $html = '<option>Choose One</option>';
        foreach ($items as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->nama . '</option>';
        }
        echo $html;
    }
}
