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
    protected $fillable = ['requirement_name', 'requirement_type', 'status', 'created_by', 'updated_by', 'deleted_by'];
    public function artist()
    {
        return $this->belongsToMany(Artist::class, 'artist_document', 'requirement_id', 'artist_id')->withPivot('doc_status', 'requirement_name', 'requirement_description', 'requirement_type', 'status');
    }
}
