<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (opsional jika nama tabelnya 'kontaks')
     */
    protected $table = 'kontaks';

    /**
     * Kolom yang boleh diisi secara massal (Mass Assignment)
     */
    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan'
    ];
}