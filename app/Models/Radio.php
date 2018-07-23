<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    protected $table = 'radio';
    protected $primaryKey = 'radio_id';

    protected $fillable = [
        'name','zip','url'
    ];
}
