<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PemilihRequest;
use App\Models\Pemilih;
use App\Models\Propinsi;
use App\Models\Tps;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PemilihController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pemilih-list|pemilih-create|pemilih-edit|pemilih-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:pemilih-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pemilih-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pemilih-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.pemilih.index');
    }

    public function getData()
    {
        $items = Pemilih::select(['pemilih.id', 'pemilih.created_at', 'pemilih.nama', 'tps.nama as tps', 'kelurahan.nama as kelurahan'])
            ->join('tps', 'pemilih.id_tps', '=', 'tps.id')
            ->join('kelurahan', 'pemilih.id_kelurahan', '=', 'kelurahan.id')
            ->orderBy('pemilih.id', 'desc');

        return DataTables::of($items)
            ->addColumn('action', function ($row) {
                $btn = '<a href="/admin/pemilih/' . $row->id . '/edit" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $row->id . "'" . ')" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
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
        $item = new Pemilih();
        $propinsis = Propinsi::all();
        $tpss = Tps::all();
        return view('pages.pemilih.create', compact('item', 'propinsis', 'tpss'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PemilihRequest $request)
    {
        $data = $request->all();
        if ($request->file('photo')) {
            $data['photo'] = $request->file('photo')->store(
                'assets/pemilih',
                'public'
            );
        }
        Pemilih::create($data);
        session()->flash('success', 'Item was created.');
        return redirect()->route('pemilih.create');
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
        $item = Pemilih::findOrFail($id);
        $propinsis = Propinsi::all();
        $tpss = Tps::all();
        return view('pages.pemilih.edit', compact('item', 'propinsis', 'tpss'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PemilihRequest $request, $id)
    {
        $data = $request->all();
        $item = Pemilih::findOrFail($id);
        if ($request->file('photo')) {
            Storage::delete($item->photo);
            $data['photo'] = $request->file('photo')->store('assets/pemilih', 'public');
        }
        $item->update($data);
        session()->flash('success', 'Item was updated.');
        return redirect()->route('pemilih.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Pemilih::findOrFail($id);
        Storage::delete($item->photo);
        $item->delete();
        return response()->json(['success' => 'Item deleted successfully']);
    }

    public function getList(Request $request)
    {
        $id_tps = $request->id_tps ?? null;
        $id_kelurahan = $request->id_kelurahan ?? null;
        $items = Pemilih::where(function ($query) use ($id_tps) {
            return $id_tps != "" ?
                $query->where('id_tps', $id_tps) : '';
        })->where(function ($query) use ($id_kelurahan) {
            return $id_kelurahan != "" ?
                $query->where('id_kelurahan', $id_kelurahan) : '';
        })->get();
        $html = '<option>Choose One</option>';
        foreach ($items as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->nama . '</option>';
        }
        echo $html;
    }
}
