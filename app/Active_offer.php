<?php

namespace App;

use App\Events\Active_offerSaved;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Active_offer extends Model
{

   

    use SoftDeletes;
    protected $tabel = 'active_offers';
    
}
