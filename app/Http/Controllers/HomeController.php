<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveiRequest;
use App\Models\Opd;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Puskesmas;
use App\Models\Stunting;
use App\Models\Survei;
use App\Models\Usia;
use App\Models\Waktu;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        // $item = Stunting::select(DB::raw('count(stunting.bb_per_tb) as jumlah', 'stunting.id_balita', 'balita.id_puskesmas'))
            // ->join('balita', 'stunting.id_balita', '=', 'balita.id')
            // ->where('stunting.bb_per_tb', 'Gizi Buruk')
            // ->where('balita.id_puskesmas', 1)
        //     ->first();
        // dd($item->jumlah);

        $puskesmas = Puskesmas::all();
        return view('stunting', compact('puskesmas'));
    }
}
