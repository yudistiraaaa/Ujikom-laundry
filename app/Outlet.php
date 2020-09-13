<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table = 'outlets';
    protected $fillable = ['nama', 'alamat', 'no_telp'];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function packets()
    {
        return $this->hasMany('App\Packet');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
