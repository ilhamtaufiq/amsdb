<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory;

    protected $table = 'tbl_kontrak';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'kode_paket',
    'kode_rup',
    'pekerjaan_id',
    'pelaksana_id',
    'nilai_kontrak',
    'tgl_mulai',
    'tgl_selesai',
    'no_sppbj',
    'tgl_sppbj',
    'no_spk',
    'tgl_spk',
    'no_spmk',
    'tgl_spmk'
    ];

    /**
     * Get the pekerjaan that owns the Kontrak
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id', 'id');
    }

    /**
     * Get the pelaksana that owns the Kontrak
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelaksana()
    {
        return $this->belongsTo(Pelaksana::class, 'pelaksana_id' , 'id');
    }
}