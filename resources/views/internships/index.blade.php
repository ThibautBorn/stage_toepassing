@extends('layout')
@section('content')
    <div class="container">
        @foreach($internships as $internship)
            @foreach($companies as $company)
                @if($company->id === $internship->company_id)
                    <h3>{{$company->name}}: {{$internship->title}}</h3>
                @endif
            @endforeach
            <ul>
                <li>{{$internship->description}}</li>
                <li>{{$internship->mentor_name}}</li>
                @foreach($internship->options as $option)
                    <ul>
                        <li>{{$option->field_of_study}} - {{$option->option_name}}</li>
                    </ul>
                @endforeach
            </ul>
        @endforeach
    </div>
@endsection


