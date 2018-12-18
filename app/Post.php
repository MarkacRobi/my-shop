<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table name
    protected $table = 'posts';
    //primary key
    protected $primaryKey = 'id';

    public $timestamps = true;
}
