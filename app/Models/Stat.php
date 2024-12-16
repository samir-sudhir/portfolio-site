<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stat extends Model
{
     use HasFactory;

    protected $fillable = ['projects_delivered', 'supported_countries', 'active_clients'];
}
