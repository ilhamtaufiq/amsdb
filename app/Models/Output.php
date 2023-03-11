<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    use HasFactory;

    protected $table = 'tbl_output';

    protected $fillable = ['pekerjaan_id', 'fisik', 'keuangan', 'triwulan'];

    /**
     * Get the pekerjaan associated with the Output
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pekerjaan()
    {
        return $this->hasOne(Pekerjaan::class, 'id', 'pekerjaan_id');
    }

    protected $casts = [
        'realisasi' => 'array',
    ];

    public function setRealisasiAttribute($value)
    {
        $realisasi = [];

        foreach ($value as $array_item) {
            if (! is_null($array_item['volume'])) {
                $realisasi[] = $array_item;
            }
        }

        $this->attributes['realisasi'] = json_encode($realisasi);
    }
}
