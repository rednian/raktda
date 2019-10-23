<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PermitRevision extends Model
{
      use SoftDeletes;
      protected $table = 'permit_revision';
      protected $primaryKey = 'permit_revision_id';
      protected $fillable = [ 'permit_number', 'permit_id'];


      public function permit()
      {
        return $this->hasMany(Permit::class, 'permit_revision_id');
      }
    
}
