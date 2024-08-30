<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Http\Controllers\tamuController;

class tamuModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_tamu',
        'no_telepon',
        'nama_instansi',
        'keperluan',
        'bertemu_dengan',
        'tanggal_bertamu',
        'waktu'
    ];
    protected $table = 'tamu';
}
