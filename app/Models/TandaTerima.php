<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TandaTerima extends Model
{
    use HasFactory;

    protected $table = 'tbl_tandaterima';

    protected $fillable = ['berkas', 'penerima', 'tanggal', 'dari'];

    protected $casts = [
        'berkas' => 'array',
    ];
}