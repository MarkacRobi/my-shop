<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    // Table name
    protected $table = 'ratings';
    //primary key
    protected $primaryKey = 'id';

    public $timestamps = true;
    //pomeni, da ima item relacijo z userjem in pripada enemu uporabniku
    public function item(){
        return $this->belongsTo('App\Item');
    }
}
