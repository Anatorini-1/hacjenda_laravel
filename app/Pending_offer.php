<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pending_offer extends Model
{
    use SoftDeletes;
    protected $table = 'pending_offers';
}
