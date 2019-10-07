<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
     use SoftDeletes;

     protected $table = 'requirement';
     protected $primaryKey = 'requirement_id';
     protected $fillable = ['requirement_name', 'requirement_description', 'term','requirement_type', 'status', 'created_by', 'updated_by', 'deleted_by'];

     public function eventTypes()
     {
     	return $this->belongsToMany(EventType::class, 'event_type_requirement', 'requirement_id', 'event_type_id');
     }

     public function requirementDocument()
     {
        return $this->hasMany(ArtistPermitDocument::class, 'document_id');
     }

}
