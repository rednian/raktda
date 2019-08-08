<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class RivisionValue extends Model
{
      use SoftDeletes;
      protected $table = 'rivision_value';
      protected $primaryKey = ['rivision_value_id'];
      protected $fillable = [ 'new_value', 'permit_rivision_id', 'artist_permit_rivision_id'];

      public function permitRivision()
      {
        return $this->belongsTo(PermitRivision::class, 'permit_rivision_id');
      }

      public function artitstPermitRivision()
      {
        return $this->belongsTo(ArtitstPermitRivision::class, 'artist_permit_rivision_id');
      }
}
