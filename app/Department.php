<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $connection = 'bls';
    protected $table = 'department';
    protected $primaryKey = 'dep_id';
    protected $fillable = ['dep_name'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'dep_id');
    }

}
