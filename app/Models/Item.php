<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Menambah proteksi (Mass Assignment) sesuai Praktikum 3
    protected $fillable = [
        'type', 
        'title', 
        'description', 
        'location', 
        'contact', 
        'status'
    ];
}