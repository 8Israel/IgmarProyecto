<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'Logs';
    protected $fillable = [user, date, data, verb] ;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
