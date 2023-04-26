<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KecamatanRequest;
use App\Models\Kecamatan;
use App\Models\Propinsi;
use App\Models\Usia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class KecamatanController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:kecamatan-list|kecamatan-create|kecamatan-edit|kecamatan-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:kecamatan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kecamatan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kecamatan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.kecamatan.index');
    }

    public function getData()
    {
        $items = Kecamatan::select(['kecamatan.id', 'kecamatan.created_at', 'kecamatan.nama', 'kabupaten.nama as kabupaten', 'propinsi.nama as propinsi'])
            ->join('kabupaten', 'kecamatan.id_kabupaten', '=', 'kabupaten.id')
            ->join('propinsi', 'kabupaten.id_propinsi', '=', 'propinsi.id')
            ->orderBy('kecamatan.id', 'desc');

        return DataTables::of($items)
            ->addColumn('action', function ($row) {
                $btn = '<a href="/admin/kecamatan/' . $row->id . '/edit" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $row->id . "'" . ')" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
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
        $item = new Kecamatan();
        $propinsis = Propinsi::all();
        return view('pages.kecamatan.create', compact('item', 'propinsis'));
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
        Kecamatan::create($data);
        session()->flash('success', 'Item was created.');
        return redirect()->route('kecamatan.create');
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
        $item = Kecamatan::findOrFail($id);
        $propinsis = Propinsi::all();
        return view('pages.kecamatan.edit', compact('item', 'propinsis'));
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
        $item = Kecamatan::findOrFail($id);
        $data['slug'] = Str::slug($request->nama);
        $item->update($data);
        session()->flash('success', 'Item was updated.');
        return redirect()->route('kecamatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Kecamatan::findOrFail($id);
        $item->delete();
        return response()->json(['success' => 'Item deleted successfully']);
    }

    public function getList($id)
    {
        $items = Kecamatan::where('id_kabupaten', $id)->get();
        $html = '<option>Choose One</option>';
        foreach ($items as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->nama . '</option>';
        }
        echo $html;
    }
}
