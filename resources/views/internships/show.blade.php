@extends('layout')
@section('content')
    <div class="container">
        <h2>{{$internship->title}}</h2>

        <h3>info</h3>

        <p><b>beschrijving:</b> {{$internship->description}}</p>

        <p><b>gewenste kandidaat:</b> {{$internship->wanted_profile}}</p>
        @if($internship->additional_information)
            <p><b>extra:</b> {{$internship->additional_information}}</p>
        @endif

        @if($internship->first_semester_possibility)
            <p><b>mogelijkheid om stage te doen in het eerste semester:</b> ja</p>
        @else
            <p><b>mogelijkheid om stage te doen in het eerste semester:</b> nee</p>
        @endif

        @if($internship->project_possibility)
            <p><b>kan gecombineerd worden met onderzoeksproject:</b> ja</p>
        @else
            <p><b>kan gecombineerd worden met onderzoeksproject:</b> nee</p>
        @endif
        <b>Opleidingen:</b>
        <p>richting: {{$internship->options[0]->field->field_name}}</p>
        <p>trajecten:</p>
        <ul>
        @foreach($internship->options as $option)
                <li>{{$option->option_name}}</li>
        @endforeach
        </ul>
        <h3>mentor</h3>
        <ul>
            <li>naam: {{$internship->mentor_name}}</li>
            <li>functie: {{$internship->mentor_function}}</li>
            <li>email: {{$internship->mentor_mail}}</li>
            <li>telefoon: {{$internship->mentor_phone}}</li>
        </ul>
    </div>
@endsection
