<?php

namespace App;
use Auth;
use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ArtistPermit extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'artist_permit';
    protected $primaryKey = 'artist_permit_id';
    protected $dates = ['created_at', 'updated_at', 'deleted_at',  'uid_expire_date', 'passport_expire_date', 'visa_expire_date', 'birthdate'];
    protected $fillable = [
        'artist_permit_status', 'artist_id', 'permit_id', 'permit_type_id', 'created_by', 'updated_by', 'deleted_by',
        'original', 'thumbnail', 'sponsor_name_ar', 'sponsor_name_en', 'visa_expire_date', 'visa_number', 'visa_type_id',
        'language_id', 'mobile_number', 'type', 'email', 'fax_number', 'po_box', 'phone_number', 'address_ar',
        'emirate_id', 'area_id', 'address_en', 'passport_expire_date', 'passport_number', 'uid_expire_date',
        'religion_id', 'identification_number', 'uid_number', 'profession_id', 'firstname_en', 'firstname_ar',
        'lastname_en', 'lastname_ar', 'birthdate', 'country_id', 'gender_id', 'is_paid', 'old_artist_id', 'replace_reason_en', 'replace_reason_ar', 'is_checked'
    ];

    public function oldArtist()
    {
        return $this->belongsTo(Artist::class, 'old_artist_id', 'artist_id');
    }


    public function scopeIsEurope($q)
    {
        return $q->whereHas('country', function($q){ $q->where('continent_code', 'EU'); });
    }


    public function scopeIsLocal($q)
    {
        return $q->whereHas('country', function($q){ $q->where('country_code', 'AE'); });
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id')->withDefault(['name_en' => null, 'name_ar' => null]);
    }

    public function check()
    {
        return $this->hasMany(ArtistPermitCheck::class, 'artist_permit_id');
    }

    public function comments()
    {
        return $this->belongsToMany(PermitComment::class, 'artist_permit_comment', 'artist_permit_id', 'permit_comment_id');
    }

    public function checklist()
    {
        return $this->hasMany(ArtistChecklist::class, 'artist_permit_id');
    }

    public function permit()
    {
        return $this->belongsTo(Permit::class, 'permit_id');
    }

    public function artistPermitDocument()
    {
        return $this->hasMany(ArtistPermitDocument::class, 'artist_permit_id');
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function emirate()
    {
        return $this->belongsTo(Emirates::class)->withDefault(['name_en' => null, 'name_ar' => null]);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')
            ->withDefault(['name_en' => null, 'name_ar' => null, 'nationality_ar' => null, 'nationality_en' => null]);
    }


    public function area()
    {
        return $this->belongsTo(Areas::class)->withDefault(['name_en' => null, 'name_ar' => null]);
    }

    public function language()
    {
        return $this->belongsTo(Language::class)->withDefault(['name_en' => null, 'name_ar' => null]);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class)->withDefault(['name_en' => null, 'name_ar' => null]);
    }

    public function visaType()
    {
        return $this->belongsTo(VisaType::class)->withDefault(['visa_type_en' => null, 'visa_type_ar' => null]);
    }

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class, 'artist_permit_transaction', 'artist_permit_id', 'transaction_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id')
            ->withDefault(['name_en' =>  null, 'name_ar' => null]);
    }

    public function Nationality()
    {
        return $this->belongsTo(Country::class, 'country_id', 'country_id')->withDefault([]);
    }

    public function getFullNameAttribute()
    {
        $user_lang = Auth::user()->LanguageId;
        if ($user_lang == 1){ return $this->firstname_en . ' ' . $this->lastname_en; }
        if ($user_lang == 2){ return $this->firstname_en . ' ' . $this->lastname_en; }

    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function artistPermitTransaction()
    {
        return $this->hasMany(ArtistPermitTransaction::class,'artist_permit_id');
    }

    public function getReplaceReasonAttribute()
    {
        return Auth::user()->LanguageId == 1 ? ucfirst($this->replace_reason_en) : ucfirst($this->replace_reason_ar);
    }

}
