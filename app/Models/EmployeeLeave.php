<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;
    protected $table = 'employee_leave';
    protected $fillable = [
        'id','status','reason','leave_start_date','leave_end_date','userid'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','userid','user_id');
    }  
    public function users()
    {
        return $this->belongsTo('App\Models\User','userid','id');
    }
    
}
