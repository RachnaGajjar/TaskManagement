<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeWorkingTime extends Model
{
    use HasFactory;
    protected $table = 'employee_working_time';
    protected $fillable = [
        'id','emp_id','day','start_time','end_time'
    ];
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','id');
    } 
   
    
}
