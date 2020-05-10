<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Offer extends Model
{
     use SoftDeletes;
     protected $tabel = 'offers';
     protected $casts = [
          'jobs' => 'array',
     ];
}
