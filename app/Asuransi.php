<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asuransi extends Model
{
    protected $fillable = [
        'users_id',
        'nama_asuransi',
        'kategori',
        'tanggal_asuransi',
        'nominal',
        'tanggal_periode',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
