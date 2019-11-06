<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArabicTranslation extends Model
{
    protected $table = 'arabic_translations';
    protected $primaryKey = 'at_id';
    protected $fillable = [
        'english', 'arabic'
    ];
}
