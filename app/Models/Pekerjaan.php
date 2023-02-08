<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'tbl_pekerjaan';

    protected $fillable = ['keg_id', 'kec_id', 'desa_id', 'nama_pekerjaan', 'pagu', 'pokir'];

    /**
     * Get the Kegiatan that owns the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'keg_id');
    }

    /**
     * Get the desa that owns the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    /**
     * Get the kec that owns the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kec()
    {
        return $this->belongsTo(Kec::class, 'kec_id');
    }

   /**
    * Get the kontrak associated with the Pekerjaan
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
   public function kontrak()
   {
       return $this->hasOne(Kontrak::class);
   }

   /**
    * Get the nphd associated with the Pekerjaan
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
   public function nphd()
   {
       return $this->hasOne(Nphd::class, 'pekerjaan_id', 'id');
   }

   /**
    * Get all of the file for the Pekerjaan
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function file()
   {
       return $this->hasMany(FileUpload::class, 'pekerjaan_id', 'id');
   }

   /**
    * Get the output associated with the Pekerjaan
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
   public function realisasi_output()
   {
       return $this->hasOne(Output::class, 'pekerjaan_id', 'id');
   }
}
