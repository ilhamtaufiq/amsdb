<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spek extends Model
{
    use HasFactory;

    protected $table = 'tbl_spek';

    protected $guarded = [];

    /**
     * Get all of the pekerjan for the Spek
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class, 'id', 'pekerjaan_id');
    }
}
