<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picmot extends Model{
    protected $fillable = ['user_id','picture','motion','lat','lon'];
}
