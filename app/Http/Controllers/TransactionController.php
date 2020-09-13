<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-invoice')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $transactions = \App\Transaction::with('outlets')->with('users')->with('members')->paginate(10);

        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $transactions = \App\Transaction::where('kode_invoice', 'LIKE', "%$filterKeyword%")->with('outlets')->with('users')->with('members')->paginate(10);
        }

        $no = 1;
        return view('transactions.index', ['transactions' => $transactions, 'nomor' => $no]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create');
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
            'kode_invoice' => 'required',
        ])->validate();

        $new_transaction = new \App\Transaction;
        $new_transaction->kode_invoice = $request->get('kode_invoice');
        $new_transaction->invoice_created = Carbon::now();
        $new_transaction->invoice_expire = Carbon::now()->addDays(5);
        $new_transaction->user_id = \Auth::user()->id;
        $new_transaction->packet_id = $request->get('packet_id');
        $new_transaction->member_id = $request->get('member_id');
        $new_transaction->outlet_id = $request->get('outlet_id');


        $new_transaction->save();
        return redirect()->route('transactions.index')->with('success', 'Data invoice baru berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $transaction = \App\Transaction::with('users')->findOrFail($id);
        // $pdf = PDF::loadview('pdf.transaction', ['transaction' => $transaction]);
        // //$pdf->save(storage_path().'_filename.pdf');
        // return $pdf->stream('transaction.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = \App\Transaction::findOrFail($id);
        return view('transactions.edit', ['transaction' => $transaction]);
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
        $transaction = \App\Transaction::findOrFail($id);
        $transaction->tgl_bayar = Carbon::now();
        $transaction->status_laundry = $request->get('status_laundry');
        $transaction->status_pembayaran = $request->get('status_pembayaran');

        $transaction->save();
        return redirect()->route('transactions.index')->with('success', 'Data invoice baru berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = \App\Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Data invoice baru berhasil di hapus');
    }

    public function ajaxSearchPacket(Request $request)
    {
        $keyword = $request->get('q');

        $packets = \App\Packet::where("nama_paket", "LIKE", "%$keyword%")->get();

        return $packets;
    }

    public function ajaxSearchMember(Request $request)
    {
        $keyword = $request->get('q');

        $members = \App\Member::where("nama", "LIKE", "%$keyword%")->get();

        return $members;
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $outlets = \App\Outlet::where("nama", "LIKE", "%$keyword%")->get();

        return $outlets;
    }

    public function exportPdf($id)
    {
        $transaction = \App\Transaction::with(['users', 'members', 'packets', 'outlets'])->find($id);
        $pdf = PDF::loadView('pdf.transaction', compact('transaction'));
        //$pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('transaction.pdf');
    }
}
