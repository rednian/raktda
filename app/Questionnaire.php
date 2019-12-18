<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questionnaire extends Model
{
    use SoftDeletes;

    protected $table = 'questionnaire';
    protected $primaryKey = 'questionnaire_id';
    protected $fillable = [
        'questionnaire_name_en', 'questionnaire_name_ar'
    ];

    protected $dates = ['deleted_at'];

    public function getCategories(){
    	return $this->belongsToMany(QuestionCategory::class, 'questionnaire_categories', 'questionnaire_id', 'question_category_id');
    }
}

