<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
        use SoftDeletes;

        protected $table = 'profession';
        protected $primaryKey = 'prof_id';
        protected $fillable = [
            'prof_name_en', 'prof_name_ar',. 'created_by', 'updated_by', 'deleted_by'
        ]

}
