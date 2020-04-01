<?php


namespace App;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public function options(){
        return $this->hasMany(Option::class);
    }

}
