

@extends('layout')
@section('content')
    <div class="container">
        <H1>Form</H1>
        <form method="POST" action="{{ route('company') }}">
            @csrf

            @if (!$errors->isEmpty())
                <!--
                <div class="alert alert-danger" role="alert">
                    <p><strong>inzending niet geslaagd!</strong> niet alle verplichte velden zijn correct ingevuld.</p>
                </div>
                -->
            @endif

            @if (Session::has('message'))
                <div class="alert alert-danger">{{ Session::get('message') }}</div>
            @endif
            <H2>Bedrijf</H2>
                <!--
            <label for="org_name">Organisatie:</label><br>
            <input class="input is-danger" type="text" name="org_name" value="{{old('org_name')}}" required><br>
            <label for="dep_name">departement (optioneel):</label><br>
            <input type="text" name="dep_name" value="{{old('dep_name')}}" required><br>
            <label for="descr">geef een beschrijving van je bedrijf:</label><br>
            <textarea rows="5" class="form-control" name="descr" value="{{old('descr')}}"required></textarea><br>
-->

            <div class="form-group @if ($errors->has('org_name')) has-danger @endif">
                <label for="org_name" class="form-control-label">organisatie:</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('org_name') ? ' is-invalid' : '' }}"name="org_name" value="{{old('org_name')}}">
                @if ($errors->has('org_name')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('org_name') }}</p> @endif
            </div>

            <label for="dep_name">departement (optioneel):</label><br>
            <input type="text" name="dep_name" value="{{old('dep_name')}}"><br>

            <div class="form-group @if ($errors->has('descr')) has-danger @endif">
                <label for="descr" class="form-control-label">geef een beschrijving van je bedrijf:</label>
                <textarea rows="5" class="form-control form-control-danger{{ $errors->has('descr') ? ' is-invalid' : '' }}" name="descr" value="{{old('descr')}}">{{old('descr')}}</textarea><br>
                @if ($errors->has('descr')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('descr') }}</p> @endif
            </div>

            <H3>adres</H3>

            <div class="form-group @if ($errors->has('street')) has-danger @endif">
                <label for="street" class="form-control-label">straat</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('street') ? ' is-invalid' : '' }}"name="street" value="{{old('street')}}">
                @if ($errors->has('street')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('street') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('number')) has-danger @endif">
                <label for="number" class="form-control-label">nummer en bus</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('number') ? ' is-invalid' : '' }}"name="number" value="{{old('number')}}">
                @if ($errors->has('number')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('number') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('municipality')) has-danger @endif">
                <label for="municipality" class="form-control-label">gemeente</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('municipality') ? ' is-invalid' : '' }}"name="municipality" value="{{old('municipality')}}">
                @if ($errors->has('municipality')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('municipality') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('zip')) has-danger @endif">
                <label for="zip" class="form-control-label">zipcode</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('zip') ? ' is-invalid' : '' }}"name="zip" value="{{old('zip')}}">
                @if ($errors->has('zip')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('zip') }}</p> @endif
            </div>

                <H2>informatie verantwoordelijke</H2>
            <!--<label for="ad_name">naam</label><br>
            <input type="text" name="ad_name" value="{{old('ad_name')}}" required><br>
            -->

            <div class="form-group @if ($errors->has('ad_name')) has-danger @endif">
                <label for="ad_name" class="form-control-label">naam</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('ad_name') ? ' is-invalid' : '' }}"name="ad_name" value="{{old('ad_name')}}">
                @if ($errors->has('ad_name')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('ad_name') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('ad_func')) has-danger @endif">
                <label for="ad_func" class="form-control-label">functie</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('ad_func') ? ' is-invalid' : '' }}"name="ad_func" value="{{old('ad_func')}}">
                @if ($errors->has('ad_func')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('ad_func') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('ad_mail')) has-danger @endif">
                <label for="ad_mail" class="form-control-label">mail</label>
                <input type="email" class="form-control form-control-danger{{ $errors->has('ad_mail') ? ' is-invalid' : '' }}"name="ad_mail" value="{{old('ad_mail')}}">
                @if ($errors->has('ad_mail')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('ad_mail') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('ad_tel')) has-danger @endif">
                <label for="ad_tel" class="form-control-label">telefoon-nummer</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('ad_tel') ? ' is-invalid' : '' }}"name="ad_tel" value="{{old('ad_tel')}}">
                @if ($errors->has('ad_tel')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('ad_tel') }}</p> @endif
            </div>
            <input class="btn btn-primary" type="submit" value="volgende"><br>
            <br>
        </form>
    </div>
@endsection
