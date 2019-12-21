<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Government extends Model
{
	use SoftDeletes;

    protected $table = 'government';
    protected $primaryKey = 'government_id';
    protected $fillable = [
        'government_name_en',
        'government_name_ar'
    ];

    protected $dates = ['deleted_at'];
}
