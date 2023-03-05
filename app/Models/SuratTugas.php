<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    use HasFactory;

    protected $table = 'tbl_tugas';

    protected $guarded = [];

    protected $casts = [
        'kepada' => 'array',
        'tujuan' => 'array',

    ];
}
