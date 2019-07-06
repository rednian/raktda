<?php

namespace App;

use Auth;
use OwenIt\Auditing\Contracts\Auditable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Auditable
{
    use Notifiable;
    use \OwenIt\Auditing\Auditable;
    use HasRoleAndPermission;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';

    protected $connection = 'bls';

    protected $table = 'user';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'nameAr', 'nameEn', 'username', 'password', 'type', 'isactive','createby', 'modifiedby'
    ];

    protected $auditInclude = [
        'nameAr', 'nameEn', 'username', 'password', 'type', 'isactive','createby', 'modifiedby'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->type == 1 ? true : false;
    }

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'roleuser', 'role_id', 'user_id');
    }

}
