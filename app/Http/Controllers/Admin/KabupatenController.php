<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KabupatenRequest;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Propinsi;
use App\Models\Usia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class KabupatenController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:kabupaten-list|kabupaten-create|kabupaten-edit|kabupaten-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:kabupaten-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kabupaten-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kabupaten-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.kabupaten.index');
    }

    public function getData()
    {
        $items = Kabupaten::select(['kabupaten.id', 'kabupaten.created_at', 'kabupaten.nama', 'propinsi.nama as propinsi'])
            ->join('propinsi', 'kabupaten.id_propinsi', '=', 'propinsi.id')
            ->orderBy('kabupaten.id', 'desc');

        return DataTables::of($items)
            ->addColumn('action', function ($row) {
                $btn = '<a href="/admin/kabupaten/' . $row->id . '/edit" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $row->id . "'" . ')" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
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
        $item = new Kabupaten();
        $propinsis = Propinsi::all();
        return view('pages.kabupaten.create', compact('item', 'propinsis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KabupatenRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);
        Kabupaten::create($data);
        session()->flash('success', 'Item was created.');
        return redirect()->route('kabupaten.create');
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
        $item = Kabupaten::findOrFail($id);
        $propinsis = Propinsi::all();
        return view('pages.kabupaten.edit', compact('item', 'propinsis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KabupatenRequest $request, $id)
    {
        $data = $request->all();
        $item = Kabupaten::findOrFail($id);
        $data['slug'] = Str::slug($request->nama);
        $item->update($data);
        session()->flash('success', 'Item was updated.');
        return redirect()->route('kabupaten.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Kabupaten::findOrFail($id);
        $item->delete();
        return response()->json(['success' => 'Item deleted successfully']);
    }

    public function getList($id)
    {
        $items = Kabupaten::where('id_propinsi', $id)->get();

        // dd($items);
        $html = '<option>Choose One</option>';
        foreach ($items as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->nama . '</option>';
        }
        echo $html;
    }
}
