<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Table name
    protected $table = 'orders';
    //primary key
    protected $primaryKey = 'id';

    //pomeni, da ima narocilo relacijo z userjem in pripada enemu uporabniku
    public function user(){
        return $this->belongsTo('App\User');
    }
}
