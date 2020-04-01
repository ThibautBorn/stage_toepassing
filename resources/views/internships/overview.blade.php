@extends('layout')
@section('content')
    <div class="container">


        <h2>{{$company->name}}</h2>
            <table>
            <thead>
            <tr>
                <th width="20%">stage titel</th>
                <th width="15%">Naam mentor</th>
                <th width="35%">opties</th>
                <th width="5%">Verwijder</th>
                <th width="5%">pas aan</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($internships as $internship)
                    <tr>
                        <td><h3>{{$internship->title}}</h3></td>
                        <td>{{$internship->mentor_name}}</td>
                        <td>
                            {{$internship->options[0]->field->field_name}}
                            <ul>
                            @foreach($internship->options as $option)
                                <li>{{$option->option_name}}</li>
                            @endforeach
                            </ul>
                        </td>
                        <td>
                            <form action="{{ route('delete_internship') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input name="id" type="hidden" value="{{$internship->id}}">
                                <button type="submit" class="btn btn-danger" title="delete_internship"><i class="material-icons">delete</i></button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('edit_internship') }}" method="POST">
                                @csrf
                                <input name="id" type="hidden" value="{{$internship->id}}">
                                <button type="submit" class="btn btn-info" title="edit_internship"><i class="material-icons">redo</i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        <form action="{{ route('edit_submission') }}" method="POST">
            @csrf
            <button class="btn btn-primary" name="submit" value="done">
                sluit af <i class="material-icons">done</i>
            </button>
            <button class="btn btn-success" name="submit" value="add">
                voeg stage toe <i class="material-icons">add</i>
            </button>
        </form>

    </div>
@endsection
