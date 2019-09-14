<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class RevisionValue extends Model
{
      use SoftDeletes;
      protected $table = 'revision_value';
      protected $primaryKey = ['revision_value_id'];
      protected $fillable = [ 'new_value', 'permit_revision_id', 'artist_permit_revision_id'];

      public function permitRevision()
      {
        return $this->belongsTo(PermitRevision::class, 'permit_revision_id');
      }

      public function artitstPermitRevision()
      {
        return $this->belongsTo(ArtitstPermitRevision::class, 'artist_permit_revision_id');
      }
}
