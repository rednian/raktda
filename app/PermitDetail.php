<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PermitDetail extends Model
{
       use SoftDeletes; 
       protected $table = 'permit_detail';
       protected $primaryKey ='permit_detail_id';
       protected $fillable = [
        'company_id', 'permit_id', 'permit_number', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function artistPermit()
    {
      return $this->hasMany(ArtistPermit::class, 'permit_detail_id');
    }

    public function permit()
    {
        return $this->belongsTo(Permit::class, 'permit_id');
    }

}
