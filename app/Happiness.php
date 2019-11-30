<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Happiness extends Model
{
    protected $table = 'happiness';
    protected $primaryKey = 'id';
    protected $fillable = ['type', 'application_id', 'remarks', 'rating', 'created_by'];
}
