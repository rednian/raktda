<?php

namespace App;

use Auth;
use Carbon\Carbon;
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
    //smartrak_bls

    protected $table = 'smartrak_bls.user';

    protected $primaryKey = 'user_id';
    protected $fillable = [
        'nameAr', 'nameEn', 'username', 'password', 'type', 'isactive', 'createby', 'modifiedby', 'EmpClientId', 'LanguageId', 'designation', 'email', 'mobile_number'
    ];

    // protected $auditInclude = [
    //     'nameAr', 'nameEn', 'username', 'password', 'type', 'isactive','createby', 'modifiedby', 'EmpClientId', 'LanguageId'
    // ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function scopeAvailableInspector($q, $start_date)
    {
        return $q->whereHas('roles', function ($q) {
            $q->where('roles.role_id', 4);
        })
            ->whereDoesntHave('leave', function ($q) use ($start_date) {
                $q->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
                    ->whereDate('end_date', '<=', date('Y-m-d', strtotime($start_date)));
            })
            ->whereType(4);
    }

    public function approver()
    {
        return $this->hasMany(Approvers::class, 'user_id');
    }

    public function leave()
    {
        return $this->hasMany(EmployeeLeave::class, 'user_id');
    }

    public  function company()
    {
        return $this->belongsTo(Company::class, 'EmpClientId', 'company_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'EmpClientId', 'employee_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'roleuser', 'user_id', 'role_id');
    }
}
