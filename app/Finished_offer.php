<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finished_offer extends Model
{
    use SoftDeletes;
     protected $tabel = 'finished_offers';
}
