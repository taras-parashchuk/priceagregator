<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'tablename';
    public $incrementing = false;
    protected $keyType = 'string';
}
