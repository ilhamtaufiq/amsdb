<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploadtmp extends Model
{
    use HasFactory;
    protected $table = 'file_tmp';
    protected $fillable = ['file', 'folder'];
}
