<?php
namespace App;
use Auth;
use Carbon\Carbon;
use App\GeneralSetting;
use OwenIt\Auditing\Contracts\Auditable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable implements Auditable, MustVerifyEmail
{
    use Notifiable;
    use \OwenIt\Auditing\Auditable;
    use HasRoleAndPermission;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';

    protected $table = 'smartrak_smartgov.user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'NameAr', 'NameEn', 'username', 'password', 'type', 'IsActive', 'CreatedBy', 'modifiedby', 'EmpClientId', 'LanguageId', 'designation', 'email', 'mobile_number'
    ];
    // protected $auditInclude = [
    //     'nameAr', 'nameEn', 'username', 'password', 'type', 'isactive','createby', 'modifiedby', 'EmpClientId', 'LanguageId'
    // ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = ['email_verified_at' => 'datetime'];
    protected $dates = ['CreatedAt'];


    public function scopeAvailableInspector($q, $start_date)
    {
        return $q->whereHas('roles', function ($q) {
            $q->where('roles.role_id', 4);
        })
        ->whereDoesntHave('leave', function ($q) use ($start_date) {
            $q->whereDate('leave_start', '>=', Carbon::now()->format('Y-m-d'))
            ->whereDate('leave_end', '<=', date('Y-m-d', strtotime($start_date)));
        })
        // ->has('approver', '<=', GeneralSetting::first()->inspection_per_day)
        ->whereDoesntHave('approver', function($q) use ($start_date){
            $q->whereNull('status');
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

    public function workschedule(){
        return $this->hasOne(EmployeeWorkSchedule::class, 'user_id');
    }

    public function customSchedules(){
        return $this->hasMany(EmployeeCustomWorkSchedule::class, 'user_id');
    }

    public function scopeAreEmployees($query){
        return $query->whereType(4);
    }

    public function scopeAreInspectors($query){
        return $query->whereType(4)->whereHas('roles', function($q){
            $q->where('roles.role_id', 4);
        });
    }

    public function appointments(){
        return $this->belongsToMany(Approval::class, 'approvers', 'user_id', 'approval_id');
    }
}

