<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    protected $table = 'tabungan';

    protected $fillable = ['users_id', 'nama_tabungan', 'tanggal_tabungan', 'nominal', 'keterangan'];
}