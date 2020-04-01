<?php

namespace App\Http\Controllers;

use App\Company;
use App\Field;
use App\Internship;
use App\Option;
use App\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;

class InternshipController extends Controller
{
    public static function messages_internship() {
        return [
            'title.required' => 'Gelieve de titel van de stage op te geven',
            'intern_descr.required' => 'Gelieve een beschrijving van de organisatie mee te geven',
            'wanted_profile.required' => 'Gelieve het gewenste profiel van de kandidaat mee te geven',
            'options.required' => 'Kies minstens 1 richting waarvoor de stage geschikt is',
            'options.exists' => 'De geselecteerde keuze was ongeldig',
            'mentor_name.required' => 'Gelieve de naam van de dagelijks begeleider op te geven',
            'mentor_func.required' => 'Gelieve de functie van de dagelijks begeleider op te geven',
            'mentor_mail.email' => 'Gelieve een geldig e-mailadres op te geven',
            'mentor_mail.required' => 'Gelieve het e-mailadres van de dagelijks begeleider op te geven',
            'mentor_tel.required' => 'Gelieve het telefoonnummer van de dagelijks begeleider op te geven',
            'mentor_tel.regex' => 'Gelieve een geldig belgisch telefoonnummer op te geven',
        ];
    }

    public static function rules_internship ()
    {
        return [
            'title' => 'required',
            'intern_descr'=> 'required',
            'wanted_profile'=> 'required',
            'options'=> 'required|exists:options,id',
            'mentor_name'=> 'required',
            'mentor_func'=> 'required',
            'mentor_mail'=> ['required','email'],
            'mentor_tel'=> ['required','regex:/^((\+|00)32\s?|0)4(60|[789]\d)(\s?\d{2}){3}$/']
        ];
    }


    public function index(){
        $internships = Internship::all();
        $companies = Company::all();

        return view('internships.index',
            ['internships'=> $internships,
              'companies' => $companies]);
    }

    public function show(Internship $internship){
        $company = Company::where('id','=',$internship->company_id)->firstOrFail();
        //dump($company->name);
        return view('internships.show',
            ['internship'=> $internship,
             'company' => $company]);

    }

    public function set_company(Request $request){
        $id = request('id');

        if(empty($request->session()->get('submission'))){
            $submission= new Submission();
            $submission->company_id = $id;
            $request->session()->put('submission', $submission);
        }else {
            $submission = $request->session()->get('submission');
            $submission->company_id = $id;
            $request->session()->put('submission', $submission);
        }

        return redirect('internform');
    }


    public function create_internship(Request $request){
        //shows the form to create company
        $submission = $request->session()->get('submission');
        $company_id = $submission->company_id;
        $options=Option::all();
        //$field_of_study_list = DB::table('options')->groupBy('field_of_study')->get();
        $internships = Internship::where('company_id','=',$company_id)->get();
        $company = Company::where('id','=',$company_id)->firstOrFail();

        $fields = DB::table('fields')->pluck("field_name","id");
        //return view('forms.internform',compact('fields'));

        return view('forms.internform')
            ->with('company',$company)
            ->with('options',$options)
            ->with('internships',$internships)
            ->with(compact('fields'));
            //->with('fields',$field_of_study_list);
    }



    public function store(Request $request){
        $submission = $request->session()->get('submission');

        if($submission->company_registration != "compleet") {
            redirect()->route('company_form');
        }

        $messages = InternshipController::messages_internship();
        $rules = InternshipController::rules_internship();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Session::flash('message', 'Er zitten fouten in het formulier. Gelieve deze op te lossen.');
            return Redirect()->Back()->withErrors($validator)->withInput();
        } else {

            $fsp = (request('first_semester_possibility') == 'true') ? true : false;
            $pp = (request('project_possibility') == 'true') ? true : false;
            $new_internship = Internship::create([
                'title' =>request('title'),
                'description'=>request('intern_descr'),
                'company_id'=>$submission->company_id,
                'wanted_profile'=>request('wanted_profile'),
                'additional_information'=>request('additional_information'),
                'first_semester_possibility'=> $fsp,
                'project_possibility'=>$pp,
                'mentor_name'=>request('mentor_name'),
                'mentor_function'=>request('mentor_func'),
                'mentor_mail'=>request('mentor_mail'),
                'mentor_phone'=>request('mentor_tel')
            ]);
            $new_internship->options()->attach(\request('options'));

            if (Auth::check()){
                $new_internship->confirmed = 'submitted';
                $new_internship->save();
                return redirect('/all_overview');
            } else {
                return redirect('/submission_overview');
            }


        }
    }

    public function view_internship(){
        $id = \request('id');
        $internship = Internship::find($id);
        $fields = Field::all();

        return view('internships.show')->with('internship',$internship)->with('fields',$fields);
    }

    public function edit_internship(Request $request){
        //$id = \request('id');
        $id = $request->id;
        $internship = Internship::find($id);
        $options=Option::all();
        $current_options= array();
        $fields = DB::table('fields')->pluck("field_name","id");
        foreach($internship->options as $option)
           array_push($current_options,$option->id);
        $option_field = Option::find($current_options[0]);
        $current_field = DB::table('fields')->where('id','=',$option_field->field_id)->first();



        return view('forms.edit_internform')
            ->with('internship',$internship)
            ->with('options',$options)
            ->with('current_options',$current_options)
            ->with(compact('fields'))
            ->with('current_field',$current_field);
    }

    public function update_internship(Request $request){
        $id = \request('id');
        $internship = Internship::find($id);

        $messages = InternshipController::messages_internship();
        $rules = InternshipController::rules_internship();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Session::flash('message', 'Er zaten fouten in het formulier. ALLE aanpassingen zijn ongedaan gemaakt.');

            //
            $options=Option::all();
            $current_options= array();
            $fields = DB::table('fields')->pluck("field_name","id");
            foreach($internship->options as $option)
                array_push($current_options,$option->id);
            $option_field = Option::find($current_options[0]);
            $current_field = DB::table('fields')->where('id','=',$option_field->field_id)->first();
            //return Redirect()->Back()->withErrors($validator)->withInput();
            return view('forms.edit_internform')->withErrors($validator)->with('internship',$internship)->with('options',$options)->with('current_options',$current_options)->with(compact('fields'))->with('current_field',$current_field);
        } else {
            $fsp = ($request->first_semester_possibility == 'true') ? true : false;
            $pp = ($request->project_possibility == 'true') ? true : false;


            $internship->title = $request->title;
            $internship->description = $request->intern_descr;
            $internship->wanted_profile = $request->wanted_profile;
            $internship->additional_information = $request->additional_information;
            $internship->first_semester_possibility = $fsp;
            $internship->project_possibility = $pp;
            $internship->mentor_name = $request->mentor_name;
            $internship->mentor_function = $request->mentor_func;
            $internship->mentor_mail = $request->mentor_mail;
            $internship->mentor_phone = $request->mentor_tel;

            $internship->options()->sync(\request('options'));

            $internship->save();
        }


        if (Auth::check()){
            return redirect('/all_overview');
        } else {
            return redirect('/submission_overview');
        }



    }

    public function delete_internship(){
        $id = \request('id');
        $internship = Internship::find($id);
        $internship->delete();

        if (Auth::check()){
            return redirect('/all_overview');
        } else {
            return redirect('/submission_overview');
        }
    }


/*
    function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');

        $data = DB::table('options')
            ->where($select, $value)
            ->groupBy($dependent)
            ->get();
        echo $data;
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }
*/

    public function getFields()
    {
        $fields = DB::table('fields')->pluck("field_id","id");
        return view('forms.internform',compact('fields'));
    }

    public function getOptions($id)
    {
        $states = DB::table("options")->where("field_id",$id)->pluck("option_name","id");
        return json_encode($states);
    }
}
