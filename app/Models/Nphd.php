<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nphd extends Model
{
    use HasFactory;

    protected $table = 'tbl_nphd';

    protected $fillable = [
        'pekerjaan_id',
        'nomor',
        'pengelola',
        'ketua',
        'bangunan',
    ];

    /**
     * Get the user associated with the Nphd
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pekerjaan()
    {
        return $this->hasOne(Pekerjaan::class, 'id', 'pekerjaan_id');
    }
}
