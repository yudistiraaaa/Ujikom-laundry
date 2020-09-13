<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-members')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $members = \App\Member::paginate(10);
        $no = 1;

        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $members = \App\Member::where('nama', 'LIKE', "%$filterKeyword%")->paginate(10);
        }

        return view('members.index', ['members' => $members, 'no' => $no]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
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
            'no_telp' => 'required|digits_between:11,13',
            'jenis_kelamin' => 'required'
        ])->validate();

        $new_member = new \App\Member;
        $new_member->nama = $request->get('nama');
        $new_member->alamat = $request->get('alamat');
        $new_member->no_telp = $request->get('no_telp');
        $arrayTostring = implode(',', $request->input('jenis_kelamin'));
        $new_member['jenis_kelamin'] = $arrayTostring;

        $new_member->save();
        return redirect()->route('members.index')->with('success', 'Data member baru berhasil ditambahkan');
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
        $member = \App\Member::findOrFail($id);
        return view('members.edit', ['member' => $member]);
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
            'no_telp' => 'required|digits_between:11,13',
            'jenis_kelamin' => 'required'
        ])->validate();

        $member = \App\Member::findOrFail($id);
        $member->nama = $request->get('nama');
        $member->alamat = $request->get('alamat');
        $member->no_telp = $request->get('no_telp');
        $arrayTostring = implode(',', $request->input('jenis_kelamin'));
        $member['jenis_kelamin'] = $arrayTostring;

        $member->save();
        return redirect()->route('members.index')->with('success', 'Data member baru berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = \App\Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Data member berhasil dihapus');
    }
}
