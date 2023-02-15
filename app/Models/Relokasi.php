<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relokasi extends Model
{
    use HasFactory;

    protected $table = 'tbl_relokasi';

    protected $fillable = ['nama', 'nik', 'alamat', 'desa', 'kecamatan', 'keterangan'];
}
