<?php

namespace App;

use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'artist';
    protected $primaryKey = 'artist_id';
    protected $fillable = ['artist_status', 'created_by', 'updated_by', 'deleted_by', 'person_code'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'birthdate'];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_artist', 'artist_id', 'company_id');
    }

    public function action()
    {
        return $this->hasMany(ArtistAction::class, 'artist_id');
    }

    public function artistPermit()
    {
        return $this->hasMany(ArtistPermit::class, 'artist_id');
    }

    public function permit()
    {
        return $this->belongsToMany(Permit::class, 'artist_permit', 'artist_id', 'permit_id');
    }


}
