<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table="title";
    protected $primaryKey="tid";
    public $timestamps=false;
    protected $guard=[];
}
