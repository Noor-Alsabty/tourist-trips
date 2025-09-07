<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotels';

    public $timestamps = true;

    public function trip()
    {
        return $this->hasOne(Trip::class);
    }

    protected $fillable=['name','image','rating'];
    protected $casts = [
        'images[]' => 'array',
    ];
}
