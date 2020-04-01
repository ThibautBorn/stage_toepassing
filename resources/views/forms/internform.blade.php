@extends('layout')
@section('content')
<meta name="csrf-token" value="{{ csrf_token() }}">
<div class="container">

        @if($internships != null && count($internships)>0 )
        <div class="row">
            <div class="col-xs-12">
                <div class="card card-tertiary">
                    <div class="card-block">
                        <h2 class="card-title">reeds gemaakte stages voor {{$company->name }}</h2>
                        <ul>
                            @foreach($internships  as $internship)
                                <li>{{$internship->title}} - {{$internship->mentor_name}} </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <H1>Stage formulier</H1>
        <form method="POST" action="{{ route('internship') }}">
            @csrf

            @if (Session::has('message'))
                <div class="alert alert-danger">{{ Session::get('message') }}</div>
            @endif

            <!--<input type="hidden" name="company_id" value="{{$company->id}}"> -->
            <div class="form-group @if ($errors->has('title')) has-danger @endif">
                <label for="title" class="form-control-label">titel:</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('title') ? ' is-invalid' : '' }}"name="title" value="{{old('title')}}">
                @if ($errors->has('title')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('title') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('intern_descr')) has-danger @endif">
                <label for="intern_descr" class="form-control-label">geef een beschrijving van de stage:</label>
                <textarea rows="5" class="form-control form-control-danger{{ $errors->has('intern_descr') ? ' is-invalid' : '' }}" name="intern_descr" value="{{old('intern_descr')}}">{{old('intern_descr')}}</textarea><br>
                @if ($errors->has('intern_descr')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('intern_descr') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('wanted_profile')) has-danger @endif">
                <label for="wanted_profile" class="form-control-label">geef het gewenste profiel van de kandidaat:</label>
                <textarea rows="5" class="form-control form-control-danger{{ $errors->has('wanted_profile') ? ' is-invalid' : '' }}" name="wanted_profile" value="{{old('wanted_profile')}}">{{old('wanted_profile')}}</textarea><br>
                @if ($errors->has('wanted_profile')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('wanted_profile') }}</p> @endif
            </div>


            <div class="form-group @if ($errors->has('options')) has-danger @endif">
                <label for="options[]" class="form-control-label" > Kies een afstudeerrichting</label><br>
                <select name="field" class="form-control" style="width:250px">
                    <option value="">--- Selecteer studierichting ---</option>
                    @foreach ($fields as $key => $value)
                        <option value="{{ $key }}" {{ old("field") == $key ? "selected":""}}>{{ $value }}</option>
                    @endforeach
                </select><br>
                <select name="options[]" class="form-control" multiple style="width:250px">
                    @if(old('options') === null)
                        <option> --opties-- </option>
                    @else
                        @foreach($options as $option)
                            @if(strval($option->field_id) === old('field'))
                            <option value="{{$option->id }}" {{ in_array(strval($option->id),old('options'),true) ? "selected":""}}>{{ $option->option_name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('options')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('options') }}</p> @endif
            </div>

            <!--
            <div class="form-group">
                <label for="option">Kies minstens 1 van de afstudeerrichtingen:</label>
                <select name="option" class="form-control"style="width:250px">
                    <option>--opties--</option>
                </select>
            </div>
            -->
<!--
            <div class="form-group @if ($errors->has('options')) has-danger @endif">
                <label for="options[]" class="form-control-label" > Kies een afstudeerrichting</label><br>
                <select name="options" class="form-control"style="width:250px">
                    <option>--opties--</option>
                </select>
                @if ($errors->has('options')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('options') }}</p> @endif
            </div>
-->

            <script type="text/javascript">

                jQuery(document).ready(function ()
                {
                    jQuery('select[name="field"]').on('change',function(){
                        var countryID = jQuery(this).val();
                        if(countryID)
                        {
                            jQuery.ajax({
                                url : 'dropdownlist/getoptions/' +countryID,
                                type : "GET",
                                dataType : "json",
                                beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                                success:function(data)
                                {
                                    console.log(data);
                                    jQuery('select[name="options[]"]').empty();
                                    jQuery.each(data, function(key,value){
                                        $('select[name="options[]"]').append('<option value="'+ key +'">'+ value +'</option>');
                                    });
                                }
                            });
                        }
                        else
                        {
                            $('select[name="options"]').empty();
                        }
                    });
                });
            </script>


            <div class="form-group @if ($errors->has('additional_information')) has-danger @endif">
                <label for="additional_information" class="form-control-label">extra informatie:</label>
                <textarea rows="5" class="form-control form-control-danger{{ $errors->has('additional_information') ? ' is-invalid' : '' }}" name="additional_information" value="{{old('additional_information')}}">{{old('additional_information')}}</textarea><br>
                @if ($errors->has('additional_information')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('additional_information') }}</p> @endif
            </div>


            <input type="checkbox" name="first_semester_possibility" value="true">
            <label for="first_semester"> Kan de stage in het eerste semester gedaan worden?</label><br>

            <input type="checkbox" name="project_possibility" value="true">
            <label for="project"> Kan de stage gecombineerd worden met een onderzoek/afstudeerproject?</label><br>
            <br>

            <H3>stage mentor</H3>
            <div class="form-group @if ($errors->has('mentor_name')) has-danger @endif">
                <label for="mentor_name" class="form-control-label">naam</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('mentor_name') ? ' is-invalid' : '' }}"name="mentor_name" value="{{old('mentor_name')}}">
                @if ($errors->has('mentor_name')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('mentor_name') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('mentor_func')) has-danger @endif">
                <label for="mentor_func" class="form-control-label">functie</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('mentor_func') ? ' is-invalid' : '' }}"name="mentor_func" value="{{old('mentor_func')}}">
                @if ($errors->has('mentor_func')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('mentor_func') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('mentor_mail')) has-danger @endif">
                <label for="mentor_mail" class="form-control-label">mail</label>
                <input type="email" class="form-control form-control-danger{{ $errors->has('mentor_mail') ? ' is-invalid' : '' }}"name="mentor_mail" value="{{old('mentor_mail')}}">
                @if ($errors->has('mentor_mail')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('mentor_mail') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('mentor_tel')) has-danger @endif">
                <label for="mentor_tel" class="form-control-label">telefoon-nummer</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('mentor_tel') ? ' is-invalid' : '' }}"name="mentor_tel" value="{{old('mentor_tel')}}">
                @if ($errors->has('mentor_tel')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('mentor_tel') }}</p> @endif
            </div>
            <!--<input class="btn btn-primary" type="submit"  action="action" value="Submit"><br> -->
            <button class="btn btn-primary" name="submit"  value="save">sla op</button><br>
            <!--
            <button class="btn btn-secondary" name="submit" value="next">
                voeg een stage toe<i class="material-icons">add</i>
            </button>
            -->
        </form>
    </div>
@endsection
