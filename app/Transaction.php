<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['kode_invoice', 'invoice_created', 'invoice_expire', 'tgl_bayar', 'status_laundry', 'status_pembayaran', 'outlet_id', 'user_id', 'member_id', 'packet_id'];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function members()
    {
        return $this->belongsTo('App\Member', 'member_id');
    }

    public function outlets()
    {
        return $this->belongsTo('App\Outlet', 'outlet_id');
    }

    public function packets()
    {
        return $this->belongsTo('App\Packet', 'packet_id');
    }
}
