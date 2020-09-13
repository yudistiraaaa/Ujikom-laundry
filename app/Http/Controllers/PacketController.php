<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PacketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-packets')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $packets = \App\Packet::with('outlets')->paginate(10);
        $no = 1;

        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $packets = \App\Packet::where('nama_paket', 'LIKE', "%$filterKeyword%")->with('outlets')->paginate(10);
        }

        return view('packets.index', ['packets' => $packets, 'no' => $no]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packets.create');
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
            'nama_paket' => 'required',
            'harga' => 'required|numeric',
            'jenis_paket' => 'required',
        ])->validate();

        $new_packet = new \App\Packet;
        $new_packet->nama_paket = $request->get('nama_paket');
        $new_packet->harga = $request->get('harga');
        $new_packet->jenis_paket = $request->get('jenis_paket');
        $new_packet->outlet_id = $request->get('outlet_id');

        $new_packet->save();
        return redirect()->route('packets.index')->with('success', 'Data paket berhasil ditambah');
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
        $packet = \App\Packet::findOrFail($id);
        $outlets = \App\Outlet::pluck('nama', 'id')->toArray();

        return view('packets.edit')->with(compact('packet', 'outlets'));
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
            'nama_paket' => 'required',
            'harga' => 'required|numeric',
            'jenis_paket' => 'required',
        ])->validate();

        $packet = \App\Packet::findOrFail($id);
        $packet->nama_paket = $request->get('nama_paket');
        $packet->harga = $request->get('harga');
        $packet->jenis_paket = $request->get('jenis_paket');
        $packet->outlet_id = $request->get('outlet_id');

        $packet->save();
        return redirect()->route('packets.index')->with('success', 'Data paket berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $packet = \App\Packet::findOrFail($id);
        $packet->delete();

        return redirect()->route('packets.index')->with('success', 'Data paket berhasil dihapus');
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $outlets = \App\Outlet::where("nama", "LIKE", "%$keyword%")->get();

        return $outlets;
    }
}
