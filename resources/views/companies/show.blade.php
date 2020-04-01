@extends('layout')
@section('content')
    <div class="container">
        <H1>Bedrijf: {{$company->name}}</H1>
        <h3>actergrond informatie</h3>
        <p><b>departement (optioneel)</b>: {{$company->department}}</p>
        <p><b>beschrijving</b>: {{$company->description}}</p>
        <p><b>Adres</b></p>
        <p>{{$company->street}} {{$company->number}} </p>
        <p>{{$company->municipality}} {{$company->zipcode}} </p>
        <h3>stage administrator</h3>
        <ul>
            <li>naam: {{$company->admin_name}}</li>
            <li>functie: {{$company->admin_function}}</li>
            <li>email: {{$company->admin_mail}}</li>
            <li>telefoon: {{$company->admin_phone}}</li>
        </ul>
        <form action="{{ route('add_to_company') }}" method="GET">
            @csrf
            <input name="id" type="hidden" value="{{$company->id}}">
            <button type="submit" class="btn btn-info" title="add_internship">voeg stage toe<i class="material-icons">add</i></button>
        </form>
    </div>
@endsection
