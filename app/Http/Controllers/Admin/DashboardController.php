<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Opd;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $opds = Opd::all();
        return view('dashboard');
    }

    public function tahun(Request $request)
    {
        // $opds = Opd::all();
        return view('dashboard');
    }
}
