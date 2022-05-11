<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guard = 'employees';
    protected $table = 'employees';
    protected $fillable = [
        'org_id','name','phonenumber','address','emergencycontact','user_id','status','token'
    ];
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization','org_id','id');
      
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
      
    }
    public function employeetask()
    {
        return $this->hasMany('App\Models\EmployeeTask','emp_id');
    }
    public function employeeworkinghours()
    {
        return $this->hasMany('App\Models\EmployeeWorkingTime','emp_id');
    }
    public function employeeleave()
    {
        return $this->hasMany('App\Models\EmployeeLeave','userid');
    } 
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   
    }
