<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-outlets')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $outlets = \App\Outlet::paginate(10);
        $no = 1;

        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $outlets = \App\Outlet::where('nama', 'LIKE', "%$filterKeyword%")->paginate(10);
        }

        return view('outlets.index', ['outlets' => $outlets, 'nomor' => $no]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outlets.create');
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
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|digits_between:10,13'
        ])->validate();

        $new_outlet = new \App\Outlet;
        $new_outlet->nama = $request->get('nama');
        $new_outlet->alamat = $request->get('alamat');
        $new_outlet->no_telp = $request->get('no_telp');

        $new_outlet->save();
        return redirect()->route('outlets.index')->with('success', 'Data outlet baru berhasil ditambah');
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
        $outlet = \App\Outlet::findOrFail($id);
        return view('outlets.edit', ['outlet' => $outlet]);
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
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|digits_between:10,13'
        ])->validate();

        $outlet = \App\Outlet::findOrFail($id);
        $outlet->nama = $request->get('nama');
        $outlet->alamat = $request->get('alamat');
        $outlet->no_telp = $request->get('no_telp');

        $outlet->save();
        return redirect()->route('outlets.index')->with('success', 'Data outlet berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outlet = \App\Outlet::findOrFail($id);
        $outlet->delete();

        return redirect()->route('outlets.index')->with('success', 'Data outlet berhasil dihapus');
    }
}
