<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Active_standing_offer extends Model
{
    use SoftDeletes;
     protected $tabel = 'active_standing_offers';
}
