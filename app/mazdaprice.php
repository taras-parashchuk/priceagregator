<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class mazdaprice extends Model
{
use HasFactory;
    protected $fillable = ['NUMBER','NUMBER2','WEIGHT','VPE','VIN','NL','TITLE','TEILEART'];
}
