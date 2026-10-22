<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu'; // Menyesuaikan dengan nama tabel di phpMyAdmin
    protected $guarded = ['id'];
}