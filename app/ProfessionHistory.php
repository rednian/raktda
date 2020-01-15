<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionHistory extends Model
{
    protected $table = 'profession_history';
    protected $primaryKey = 'profession_history_id';
    protected $fillable = ['old_amount', 'new_amount', 'old_name_en', 'old_name_ar', 'new_name_ar', 'new_name_en', 'updated_by'];
    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'updated_by');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }
}
