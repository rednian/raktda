<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $table = 'fines';
    protected $primaryKey = 'fine_id';

    protected $fillable = [
    	'name_ar',
    	'name_en',
    	'description_ar',
    	'description_en',
    	'amount',
    	'created_at',
    	'updated_at',
    	'deleted_at',
    	'created_by',
    	'updated_by',
    	'deleted_by',
    ];

    protected $dates = ['deleted_at'];
}
