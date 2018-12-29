<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Table name
    protected $table = 'items';
    //primary key
    protected $primaryKey = 'id';

    public $timestamps = true;
    //pomeni, da ima post relacijo z userjem in pripada enemu uporabniku
    public function user(){
        return $this->belongsTo('App\User');
    }
}
