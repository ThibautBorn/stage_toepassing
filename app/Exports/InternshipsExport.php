<?php

namespace App\Exports;

use App\Company;
use App\Internship;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

//class InternshipsExport implements FromCollection,withHeadings
//{
    /**
    * @return \Illuminate\Support\Collection
    */
/*
    public function collection()
    {
        //AANPASSEN NAAR WITH VIEWS VOOR COMBINEREN VAN TABELLEN!
        //https://docs.laravel-excel.com/3.1/exports/from-view.html
        //return Internship::select('title', 'description', 'company_id', 'wanted_profile','additional_information','first_semester_possibility','project_possibility','mentor_name','mentor_function','mentor_mail','mentor_phone')->get();
        return view('admin.excel_table',[
           'internships' => Internship::where('confirmed','=','submitted')->get(),
            'companies' => Company::all(),
        ]);
    }

    public function headings() : array
    {
        return [
            'Titel',
            'Beschrijving',
            'Bedrijf',
            'gewenst profiel',
            'extra informatie',
            'optie voor 1 semester',
            'combinatie met aftudeerproject mogelijk',
            'mentor naam',
            'mentor functie',
            'mentor email',
            'mentor nummer',
        ];
    }
    */

    class InternshipsExport  implements FromView
    {
        public function view(): View
        {
            return view('admin.excel_table',[
                'internships' => Internship::where('confirmed','=','submitted')->get(),
                'companies' => Company::all(),
            ]);
        }
    }
//}
