<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kec extends Model
{
    use HasFactory;

    protected $table = 'tbl_kec';

    /**
     * Get all of the desa for the Kec
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function desa()
    {
        return $this->hasMany(Desa::class, 'kec_id', 'id');
    }

    /**
     * Get all of the pekerjaan for the Kec
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class, 'kec_id', 'id');
    }
}
