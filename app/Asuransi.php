<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asuransi extends Model
{
    protected $table = 'asuransi';

    protected $fillable = ['users_id', 'nama_asuransi', 'kategori', 'tanggal_asuransi', 'nominal', 'periode', 'keterangan'];
}
