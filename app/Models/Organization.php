<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'organization';
    protected $fillable = [
        'name', 'year','email','phonenumber','address','website'
];
     public function employee()
    {
         return $this->hasMany('App\Models\Employee','id','org_id');
    }
 }
