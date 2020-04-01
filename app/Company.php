<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    //$fillable geeft aan welke gegevens door de gebruiker via bv formulier (aka Mass Assignement) mogen worden aangepast tegelijkerijd (vanwege gebruik Company::Create bij voor companies in store
    protected $fillable =['name','departement','description', 'street','number','municipality','zipcode','admin_name','admin_function','admin_mail','admin_phone'];

    public function internships(){
        return $this->hasMany(Internship::class);
    }

}
