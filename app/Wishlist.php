<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';

    protected $fillable = ['users_id', 'nama_wishlist', 'kategori', 'tanggal_wishlist', 'nominal', 'tanggal_target', 'keterangan'];
}
