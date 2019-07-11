<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
     use SoftDeletes;

    protected $table = 'event_type';
    protected $primaryKey = 'event_type_id';
    protected $fillable = ['permit_code', 'name_en', 'name_ar',  'amount_fee', 'permit_type', 'created_by', 'updated_by', 'deleted_by'];

}
