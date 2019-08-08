<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistChecklist extends Model
{
    protected $table = 'artist_checklist';
    protected $primaryKey = 'checklist_id';
    protected $fillable = [
        'name', 'nationality', 'birthdate', 'passport_number', '', 'uid_number', 'mobile_number', 'phone_number', 'email',
        'person_code', 'artist_permit_id','passport_issued_date', 'passport_expired_date', 'uid_issued_date', 'uid_expired_date', 'profession',
        'artist_status'
    ];


    public function artistPermit()
    {
        return $this->belongsTo(ArtistPermit::class, 'artist_permit_id');
    }

}
