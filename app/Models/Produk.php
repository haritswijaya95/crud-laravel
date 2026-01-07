<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    
    // Properti $fillable menentukan field mana yang dapat diisi
    // secara massal (mass-assignable) menggunakan metode create() atau update().
    protected $fillable = [
        'nama',
        'jenis',
        'deskripsi',
        'harga_jual',
        'harga_beli',
        'foto', // Tambahkan koma di akhir ini (opsional, tapi baik)
    ];
}