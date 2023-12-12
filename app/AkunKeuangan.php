<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AkunKeuangan extends Model
{
    protected $table = 'akun_keuangan';

    protected $fillable = ['nama_rekening', 'no_rekening'];
}
