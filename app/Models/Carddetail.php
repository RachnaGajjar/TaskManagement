<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carddetail extends Model
{
    use HasFactory;
    protected $table = 'card_details';
    protected $fillable = [
        'id','card_name','card_number','csv','expire_month','expire_year','customer_id','card_token','user_id'
    ];
}
