<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [
        'name',
        'created_at',
        'uplod_at'
    ];

    public $timestamps = false;
}