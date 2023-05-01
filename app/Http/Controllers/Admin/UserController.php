<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Tps;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->is_admin == 'Y') {
            $items = User::where(function ($query) use ($request) {
                return $request->nama ?
                    $query->where('name', 'LIKE', '%' . $request->nama . '%') : '';
            })->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $items = User::where('id', auth()->user()->id)->paginate(10);
        }
        return view('pages.user.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new User();
        $roles = Role::pluck('name', 'name')->all();
        $tpss = Tps::all();
        return view('pages.user.create', compact('item', 'roles', 'tpss'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $user = User::create($data);
        $user->assignRole($request->input('roles'));
        $user->tps()->attach($request->id_tps);
        session()->flash('success', 'User was created.');
        return redirect()->route('user.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = User::findOrFail($id);
        return view('pages.user.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::findOrFail($id);
        $roles = Role::pluck('name', 'name')->all();
        $tpss = Tps::all();
        $userRole = $item->roles->pluck('name', 'name')->all();
        return view('pages.user.edit', compact('item', 'roles', 'userRole', 'tpss'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string:255',
            'username' => 'required',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'roles' => 'required'
        ]);

        $data = $request->all();
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $item->password;
        }
        // dd($data);
        $item->update($data);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $item->assignRole($request->input('roles'));
        $item->tps()->sync($request->id_tps);
        session()->flash('success', 'User was updated.');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        $item->opd()->detach();
        session()->flash('success', 'User was Deleted.');
        return redirect()->route('user.index');
    }

    public function cekTelpon($val)
    {
        $item = User::where('telpon', $val)->count();
        if ($item > 0) {
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
