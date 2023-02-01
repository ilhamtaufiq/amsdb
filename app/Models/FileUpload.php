<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    use HasFactory;

    protected $table = 'tbl_file';

    protected $fillable = [
        'pekerjaan_id',
        'jenis',
        'nama',
        'path',
        'file',
    ];

    /**
     * Get the pekerjaan that owns the FileUpload
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id', 'id');
    }
}
