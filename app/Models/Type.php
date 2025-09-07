<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
        protected $table = 'types';
    public $timestamps = true;
protected $fillable=[
    'name',
];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
