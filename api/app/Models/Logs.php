<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\User;

class Logs extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'Logs';
    protected $fillable = ['user_id', 'data', 'verb'] ;

}
