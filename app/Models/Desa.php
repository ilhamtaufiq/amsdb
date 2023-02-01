<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'tbl_desa';

    /**
     * Get the kecamatan associated with the Desa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kecamatan()
    {
        return $this->hasOne(Kecamatan::class, 'id', 'kec_id');
    }
}
