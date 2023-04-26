<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StuntingRequest;
use App\Models\Pendidikan;
use App\Models\Propinsi;
use App\Models\Stunting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class StuntingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:stunting-list|stunting-create|stunting-edit|stunting-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:stunting-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:stunting-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:stunting-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.stunting.index');
    }

    public function getData()
    {
        $items = Stunting::select(['stunting.id', 'stunting.created_at', 'stunting.tgl_pengukuran', 'puskesmas.nama as puskesmas', 'kelurahan.nama as kelurahan', 'balita.nama as balita'])
            ->join('balita', 'stunting.id_balita', '=', 'balita.id')
            ->join('puskesmas', 'balita.id_puskesmas', '=', 'puskesmas.id')
            ->join('kelurahan', 'balita.id_kelurahan', '=', 'kelurahan.id')
            ->orderBy('stunting.id', 'desc');

        return DataTables::of($items)
            ->addColumn('action', function ($row) {
                $btn = '<a href="/admin/stunting/' . $row->id . '/edit" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $row->id . "'" . ')" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
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
        $item = new Stunting();
        $propinsis = Propinsi::all();
        return view('pages.stunting.create', compact('item', 'propinsis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StuntingRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);
        Stunting::create($data);
        session()->flash('success', 'Item was created.');
        return redirect()->route('stunting.create');
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
        $item = Stunting::findOrFail($id);
        $propinsis = Propinsi::all();
        return view('pages.stunting.edit', compact('item', 'propinsis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StuntingRequest $request, $id)
    {
        $data = $request->all();
        $item = Stunting::findOrFail($id);
        $data['slug'] = Str::slug($request->nama);
        $item->update($data);
        session()->flash('success', 'Item was updated.');
        return redirect()->route('stunting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Stunting::findOrFail($id);
        $item->delete();
        return response()->json(['success' => 'Item deleted successfully']);
    }
}
