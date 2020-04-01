@extends('layout')
@section('content')
    <div class="container">
        <H1>Form</H1>
        <form method="POST" action="{{ route('update_company') }}">
            @csrf
            @method('PUT')

            @if (!$errors->isEmpty())
                <div class="alert alert-danger" role="alert">
                    <p><strong>inzending niet geslaagd!</strong> niet alle verplichte velden zijn correct ingevuld.</p>
                </div>
            @endif

            <H2>Bedrijf</H2>
            <input type="hidden" name="id" value="{{$company->id}}">
            <label for="org_name">Organisatie:</label><br>
            <input class="input is-danger" type="text" name="org_name" value="{{$company->name}}"><br>
            <label for="dep_name">departement (optioneel):</label><br>
            <input type="text" name="dep_name" value="{{$company->department}}"><br>
            <label for="descr">geef een beschrijving van je bedrijf:</label><br>
            <textarea rows="4" cols="50" name="descr" >{{$company->description}}</textarea><br>

            <H3>adres</H3>

            <label for="street">street:</label><br>
            <input type="text" name="street" value="{{$company->street}}"><br>
            <label for="number">nummer en bus:</label><br>
            <input type="text" name="number" value="{{$company->number}}"><br>

            <label for="municipality">Gemeente</label><br>
            <input type="text" name="municipality" value="{{$company->municipality}}"><br>
            <label for="zip">Postcode</label><br>
            <input type="number" name="zip" value="{{$company->zipcode}}"><br>

            <H2>informatie verantwoordelijke</H2>
            <label for="ad_name">naam</label><br>
            <input type="text" name="ad_name" value="{{$company->admin_name}}"><br>
            <label for="ad_func">functie</label><br>
            <input type="text" name="ad_func"  value="{{$company->admin_function}}"><br>

            <label for="ad_mail">mail</label><br>
            <input type="email" name="ad_mail" value="{{$company->admin_mail}}"><br>
            <label for="ad_tel">telefoon-nummer</label><br>
            <input type="text" name="ad_tel" value="{{$company->admin_phone}}"><br>
            <br>
            <input class="btn btn-primary" type="submit" value="sla op"><br>
            <br>
        </form>
    </div>
@endsection
