<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investasi extends Model
{
    protected $table = 'investasis'; // Set the table name

    protected $fillable = [
        'user_id',
        'id_jenis',
        'id_kategori',
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

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
