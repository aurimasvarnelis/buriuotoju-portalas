<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    protected $table = 'forecast';

    protected $fillable = ['name', 'windSpeed', 'forecastTimeUtc'];
    public $timestamps = false;
    
}