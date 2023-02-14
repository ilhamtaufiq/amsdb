<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tinja extends Model
{
    use HasFactory;

    protected $table = 'tbl_tinja';

    protected $fillable = ['nama', 'nominal', 'pembayaran', 'nomor', 'jumlah'];
}
