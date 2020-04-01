@extends('layout')
@section('content')
    <div class="container">
        @foreach($companies as $company)
            <H1>{{$company->name}}</H1>
            <p>{{$company->description}}</p>
        @endforeach
    </div>
@endsection
