<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-users')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $users = \App\User::with('outlets')->paginate(10);
        $no = 1;

        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $users = \App\User::where('name', 'LIKE', "%$filterKeyword%")->with('outlets')->paginate(10);
        }

        return view('users.index', ['users' => $users, 'no' => $no]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'username' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'roles' => 'required'
        ])->validate();

        $new_user = new \App\User;
        $new_user->name = $request->get('name');
        $new_user->email = $request->get('email');
        $new_user->username = $request->get('username');
        $new_user->roles = json_encode($request->get('roles'));
        $new_user->password = \Hash::make($request->get('password'));
        $new_user->outlet_id = $request->get('outlet_id');

        $new_user->save();
        return redirect()->route('users.index')->with('success', 'Data user berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::with('outlets')->findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::with('outlets')->findOrFail($id);
        $outlets = \App\Outlet::pluck('nama', 'id')->toArray();

        return view('users.edit')->with(compact('user', 'outlets'));
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
        \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'roles' => 'required'
        ])->validate();

        $user = \App\User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->roles = $request->get('roles');

        $user->save();
        return redirect()->route('users.index')->with('success', 'Data user berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Data user berhasil dihapus');
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $outlets = \App\Outlet::where("nama", "LIKE", "%$keyword%")->get();

        return $outlets;
    }
}
