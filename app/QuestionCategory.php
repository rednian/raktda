<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionCategory extends Model
{
    use SoftDeletes;

    protected $table = 'question_categories';
    protected $primaryKey = 'question_category_id';
    protected $fillable = [
        'question_category_name_en', 'question_category_name_ar'
    ];

    protected $dates = ['deleted_at'];

    public function getQuestions(){
    	return $this->belongsToMany(Question::class, 'question_lists', 'question_category_id', 'question_id');
    }
}
