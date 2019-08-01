<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PermitType extends Model
{
    use SoftDeletes;
    protected $table = 'permit_type';
    protected $primaryKey = 'permit_type_id';
    protected $fillable = [
        'name_en', 'name_ar', 'permit_type', 'status', 'amount', 'duration', 'created_by', 'updated_by', 'deleted_by',
    ];

    public function artist()
    {
        return $this->hasMany(ArtistPermit::class, 'permit_type_id')->where('status', 'artist');
    }

    public function event()
    {
        return $this->hasMany(ArtistPermit::class, 'permit_type_id')->where('status', 'event');
    }
}
