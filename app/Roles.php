<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'ModifiedAt';

    protected $connection = 'bls';

    protected $table = 'roles';

    protected $primaryKey = 'role_id';

    protected $fillable = [
        'NameAr', 'NameEn', 'username', 'remarks', 'AppID', 'Type', 'IsActive','Createby', 'Modifiedby'
    ];

    protected $auditInclude = [
       'NameAr', 'NameEn', 'username', 'Remarks', 'AppID', 'Type', 'IsActive','Createby', 'Modifiedby'
    ];

    public function approvers()
    {
        return $this->belongsTo(ApproverProcedure::class, 'role_id');
    }

    

     public function users()
    {
        return $this->belongsToMany(User::class, 'roleuser', 'role_id', 'user_id');
    }
}
