<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionChoice extends Model
{
    use SoftDeletes;

    protected $table = 'question_choices';
    protected $primaryKey = 'question_choice_id';
    protected $fillable = [
        'question_choice_name_en', 'question_choice_name_ar', 'question_id', 'question_choice_score'
    ];

    protected $dates = ['deleted_at'];

    public function getQuestion(){
    	return $this->belongsTo(Question::class, 'question_id');
    }
}
