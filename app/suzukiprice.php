<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class suzukiprice extends Model
{
    use HasFactory;

    protected $fillable = ['NUMBER','NUMBER2','WEIGHT','VPE','VIN','NL','TITLE','TEILEART'];
    //public $timestamps = false;
    protected $primaryKey = 'NUMBER';
    public $incrementing = false;
    protected $keyType = 'string';
}
