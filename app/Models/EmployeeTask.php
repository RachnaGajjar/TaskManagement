<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeTask extends Model
{
    use HasFactory;
    protected $table = 'employee_tasks';
    protected $fillable = [
        'id','emp_id','status','taskname','descriptions','date','start_time','end_time'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','emp_id','id');
    } 
   
  
}
