<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $fillable = ['nama', 'alamat', 'no_telp', 'jenis_kelamin'];

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
