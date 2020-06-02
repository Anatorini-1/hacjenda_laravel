<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Offer extends Model
{
     use SoftDeletes;
     protected $tabel = 'offers';
     protected $casts = [
          'jobs' => 'array',
     ];
     protected $fillable = [
          'user_id',
     ];
    
    
}
