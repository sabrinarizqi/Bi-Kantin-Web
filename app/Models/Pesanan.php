<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan'; // Menyesuaikan dengan nama tabel di phpMyAdmin
    protected $guarded = ['id'];
}