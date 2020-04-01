<?php


namespace App\Http\Controllers;
use App\Field;
use App\Mail\ContactAdmin;
use App\Mail\ContactCompany;
use Illuminate\Http\Request;
use App\Company;
use App\Internship;
use App\Option;
use App\Submission;
use Illuminate\Support\Facades\Mail;

class SubmissionController extends Controller
{


    public function review_submission(Request $request){
        $submission = $request->session()->get('submission');
        $id = $submission->company_id;

        $company = Company::where('id','=',$id)->firstOrFail();
        $internships = Internship::where('company_id','=',$id)->get();
        $fields = Field::all();
        return view('internships.overview')->with('company',$company)->with('internships', $internships)->with('fields',$fields);


    }

    public function edit_submission(){
        switch (\request('submit')) {
            case 'done':
                return redirect('/confirmation');

            case 'add':
                return redirect('/internform');
        }

    }

    public function finalize_submission(Request $request){
        $submission = $request->session()->get('submission');
        $id = $submission->company_id;

        $company = Company::find($id);
        $internships = Internship::where('company_id','=',$id)->get();
        foreach ($internships as $internship){
            $internship->confirmed = 'submitted';
            $internship->save();
        }

        Mail::to('info@ucll_stages.com')->send(new ContactCompany($company,$internships));
        Mail::to($company->admin_mail)->send(new ContactAdmin($company));

        return view('confirmation')->with('company',$company);

    }

}
