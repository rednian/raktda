<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class companyArtistDraft extends Model
{
    protected $table = 'company_artist_draft';
    protected $primaryKey = 'id';
    protected $fillable = ['referNo', 'userId', 'section', 'stepOne', 'stepTwo', 'stepThree', 'companyID'];
}
