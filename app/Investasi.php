<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investasi extends Model
{
    protected $table = 'investasis'; // Set the table name

    protected $fillable = [
        'user_id',
        'investasi',
        'nama_investasi',
        'nama_bank',
        'date',
        'time',
        'nominal_modal',
        'nominal_investasi',
        'jumlah',
        'status',
        'keterangan',
    ];

    // Relationships
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }
}
