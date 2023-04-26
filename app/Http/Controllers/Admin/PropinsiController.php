<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropinsiRequest;
use App\Imports\ExcelImport;
use App\Models\Propinsi;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PropinsiController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:propinsi-list|propinsi-create|propinsi-edit|propinsi-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:propinsi-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:propinsi-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:propinsi-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.propinsi.index');
    }

    public function getData()
    {
        $items = Propinsi::select(['propinsi.id', 'propinsi.created_at', 'propinsi.nama'])
        ->orderBy('propinsi.id', 'desc');

        return DataTables::of($items)
            ->addColumn('action', function ($row) {
                $btn = '<a href="/admin/propinsi/' . $row->id . '/edit" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $row->id . "'" . ')" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
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
        $item = new Propinsi();
        return view('pages.propinsi.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropinsiRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);
        Propinsi::create($data);
        session()->flash('success', 'Item was created.');
        return redirect()->route('propinsi.create');
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
        $item = Propinsi::findOrFail($id);
        return view('pages.propinsi.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropinsiRequest $request, $id)
    {
        $data = $request->all();
        $item = Propinsi::findOrFail($id);
        $data['slug'] = Str::slug($request->nama);
        $item->update($data);
        session()->flash('success', 'Item was updated.');
        return redirect()->route('propinsi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Propinsi::findOrFail($id);
        $item->delete();
        return response()->json(['success' => 'Item deleted successfully']);
    }

    public function import()
    {
        (new ExcelImport)->import(public_path('/balita.xlsx'));
    }
}
