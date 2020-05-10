<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
     protected $tabel = 'offers';
     protected $casts = [
          'jobs' => 'array',
     ];
}
