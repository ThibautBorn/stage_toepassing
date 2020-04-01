<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Internship extends Model
{
    protected $fillable =['title','description','company_id', 'wanted_profile','additional_information','first_semester_possibility','project_possibility','mentor_name','mentor_function','mentor_mail','mentor_phone'];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function options(){
        return $this->belongsToMany(Option::class,'option_stage');
    }
}
