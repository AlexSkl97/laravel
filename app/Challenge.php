<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $table = 'challenges';
    
    public $primaryKey = 'id';

    public $timestamps = true;
}
