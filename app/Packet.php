<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    protected $table = 'packets';
    protected $fillable = ['nama_paket', 'harga', 'jenis_paket', 'outlet_id'];

    public function outlets()
    {
        return $this->belongsTo('App\Outlet', 'outlet_id');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
