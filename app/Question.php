<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'questions';
    protected $primaryKey = 'question_id';
    protected $fillable = [
        'question_name_en', 'question_name_ar', 'question_type', 'is_required_image'
    ];

    protected $dates = ['deleted_at'];

    public function getChoices(){
    	return $this->hasMany(QuestionChoice::class, 'question_id');
    }
}
