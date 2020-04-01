<?php

namespace App\Http\Controllers;

use App\Internship;
use App\Option;
use App\Submission;
use Illuminate\Http\Request;
use App\Company;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class CompanyController extends Controller
{

    public static function messages_company() {
        return [
            'org_name.required' => 'Gelieve de naam van de organisatie op te geven',
            'descr.required' => 'Gelieve een korte beschrijving van de organisatie op te geven',
            'street.required' => 'Gelieve de straat van de organisatie mee te geven',
            'number.required' => 'Gelieve het nummer van de organisatie mee te geven',
            'municipality.required' => 'Gelieve de gemeente van de organisatie mee te geven',
            'zip.required' => 'Gelieve de zipcode van de organisatie mee te geven',
            'ad_name.required' => 'Gelieve de naam van de algemene begeleider op te geven',
            'ad_func.required' => 'Gelieve de functie van de algemene begeleider op te geven',
            'ad_mail.email' => 'Gelieve een geldig e-mailadres op te geven',
            'ad_mail.required' => 'Gelieve het e-mailadres van de algemene begeleider op te geven',
            'ad_tel.required' => 'Gelieve het telefoonnummer van de algemene begeleider op te geven',
            'ad_tel.regex' => 'Gelieve een geldig belgisch telefoonnummer op te geven',
        ];
    }

    public static function rules_company ()
    {
        return [
            'org_name' => 'required',
            'descr' => 'required',
            'street'=> 'required',
            'number'=> 'required',
            'municipality'=> 'required',
            'zip'=> 'required',
            'ad_name'=> 'required',
            'ad_func'=> 'required',
            'ad_mail'=> ['required','email'],
            'ad_tel'=> ['required','regex:/^((\+|00)32\s?|0)4(60|[789]\d)(\s?\d{2}){3}$/']
        ];
    }


    public function index(){
        $companies = Company::all();

        return view('companies.index',
            ['companies'=> $companies]);
    }

    public function show(Company $company){

        return view('companies.show',
            ['company'=> $company]);

    }

    public function create(Request $request){
        return view('forms.companyform');
    }

    public function store(Request $request){
        //saves the resource/company

        $messages = CompanyController::messages_company();
        $rules = CompanyController::rules_company();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Session::flash('message', 'Er zitten fouten in het formulier. Gelieve deze op te lossen.');
            return Redirect()->Back()->withErrors($validator)->withInput();
        } else {
            $new_company = Company::create([
                'name' =>request('org_name'),
                'department'=>request('dep_name'),
                'description'=>request('descr'),
                'street'=>request('street'),
                'number'=>request('number'),
                'municipality'=>request('municipality'),
                'zipcode'=>request('zip'),
                'admin_name'=>request('ad_name'),
                'admin_function'=>request('ad_func'),
                'admin_mail'=>request('ad_mail'),
                'admin_phone'=>request('ad_tel')
            ]);

            $new_company->department = request('dep_name');
            $new_company->save();

            $id = $new_company->id;

            if(empty($request->session()->get('submission'))){
                $submission= new Submission();
                $submission->company_id = $id;
                $submission->company_registration = "compleet";
                $request->session()->put('submission', $submission);
            }else {
                $submission = $request->session()->get('submission');
                $submission->company_id = $id;
                $submission->company_registration = "compleet";
                $request->session()->put('submission', $submission);
            }

            return redirect('/internform');
        }

    }

    public function view_company(){
        $id = \request('id');
        $company = Company::find($id);

        return view('companies.show')->with('company',$company);
    }

    public function edit_company(Request $request){

        $id = $request->id;
        $company = Company::find($id);

        return view('forms.edit_companyform')->with('company',$company);

    }

    public function update_company(Request $request){
        $id = \request('id');
        $company = Company::find($id);

        $messages = CompanyController::messages_company();
        $rules = CompanyController::rules_company();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Session::flash('message', 'Er zaten fouten in het formulier.De aanpassing is niet uitgevoerd.');
        } else {
            $company->name = $request->org_name;
            $company->department = $request->dep_name;
            $company->description = $request->descr;
            $company->street = $request->street;
            $company->number = $request->number;
            $company->municipality = $request->municipality;
            $company->zipcode = $request->zip;

            $company->admin_name = $request->ad_name;
            $company->admin_function = $request->ad_func;
            $company->admin_mail = $request->ad_mail;
            $company->admin_phone = $request->ad_tel;

            $company->save();

        }

        if (Auth::check()){
            return redirect('/companies_overview');
        } else {
            return redirect('/submission_overview');
        }
    }

    public function delete_company(){
        $id = \request('id');
        $company = Company::find($id);
        $company->delete();

        if (Auth::check()){
            return redirect('/companies_overview');
        } else {
            return redirect('/submission_overview');
        }
    }
}
