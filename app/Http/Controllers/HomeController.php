<?php

namespace App\Http\Controllers;

use App\Company;
use App\Internship;
use Illuminate\Http\Request;
use App\Exports\InternshipsExport;
use Maatwebsite\Excel\Facades\Excel;
use Redirect,Response,DB,Config;
use Datatables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function list_all()
    {
        $internships = Internship::where('confirmed','=','submitted')->get();
        $companies = Company::all();
        return view('admin.all')->with('internships',$internships)->with('companies',$companies);
    }

    public function list_companies()
    {
        $companies = Company::all();
        return view('admin.companies')->with('companies',$companies);
    }

    public function export()
    {
        return Excel::download(new InternshipsExport, 'stagemogelijkheden.xlsx');
    }

}
