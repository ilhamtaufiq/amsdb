<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'tbl_kegiatan';

    protected $fillable = ['program', 'kegiatan', 'sub_kegiatan', 'tahun_anggaran', 'sumber_dana'];

    /**
     * Get all of the pekerjaan for the Kegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class, 'keg_id', 'id');
    }
}
