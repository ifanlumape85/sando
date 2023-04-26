<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TpsRequest;
use App\Models\Opd;
use App\Models\Propinsi;
use App\Models\Tps;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class TpsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:tps-list|tps-create|tps-edit|tps-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:tps-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tps-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tps-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.tps.index');
    }

    public function getData()
    {
        $items = Tps::select(['tps.id', 'tps.created_at', 'tps.nama', 'kelurahan.nama as kelurahan'])
            ->join('kelurahan', 'tps.id_kelurahan', '=', 'kelurahan.id')
            ->orderBy('tps.id', 'desc');

        return DataTables::of($items)
            ->addColumn('action', function ($row) {
                $btn = '<a href="/admin/tps/' . $row->id . '/edit" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $row->id . "'" . ')" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
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
        $item = new Tps();
        $propinsis = Propinsi::all();
        return view('pages.tps.create', compact('item', 'propinsis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TpsRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);
        Tps::create($data);
        session()->flash('success', 'Item was created.');
        return redirect()->route('tps.create');
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
        $item = Tps::findOrFail($id);
        $propinsis = Propinsi::all();
        return view('pages.tps.edit', compact('item', 'propinsis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TpsRequest $request, $id)
    {
        $data = $request->all();
        $item = Tps::findOrFail($id);
        $data['slug'] = Str::slug($request->nama);
        $item->update($data);
        session()->flash('success', 'Item was updated.');
        return redirect()->route('tps.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Tps::findOrFail($id);
        $item->delete();
        return response()->json(['success' => 'Item deleted successfully']);
    }

    public function getList($id)
    {
        $items = Tps::where('id_kelurahan', $id)->get();
        $html = '<option>Choose One</option>';
        foreach ($items as $item) {
            $html .= '<option value="' . $item->id  . '">' . $item->nama  . '</option>';
        }
        echo $html;
    }
}
