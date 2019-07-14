<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
     use SoftDeletes;   

    protected $table = 'permit';
    protected $primaryKey = 'permit_id';
    protected $fillable = ['permit_type', 'company_id', 'created_by', 'updated_by', 'deleted_by'];

    public function permitDetail()
    {
       return $this->hasMany(PermitDetail::class, 'permit_id');
    }
}
