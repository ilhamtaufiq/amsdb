<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spek extends Model
{
    use HasFactory;

    protected $table = 'tbl_spek';

    protected $guarded = [];

    protected $casts = [
        'spek' => 'array',
    ];

    public function setSpekAttribute($value)
    {
        $spek = [];

        foreach ($value as $array_item) {
            if (! is_null($array_item['volume'])) {
                $spek[] = $array_item;
            }
        }

        $this->attributes['spek'] = json_encode($spek);
    }
}
