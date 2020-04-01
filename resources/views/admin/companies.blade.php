@extends('layout')
@section('content')

    <div class="container" >
        @if (Session::has('message'))
            <div class="alert alert-danger">{{ Session::get('message') }}</div>
        @endif
        <table id="example">
            <thead>
            <tr>
                <th width="20%">bedrijf</th>
                <th width="20%">departement</th>
                <th width="15%">Naam admin</th>
                <th width="5%">toon</th>
                <th width="5%">bewerk</th>
                <th width="5%">Verwijder</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($companies as $company)
                <tr>
                    <td><h3>{{$company->name}}</h3></td>
                    <td>{{$company->department}}</td>
                    <td>{{$company->admin_name}}</td>
                    <td>
                        <form action="{{ route('view_company') }}" method="GET">
                            @csrf
                            <input name="id" type="hidden" value="{{$company->id}}">
                            <button type="submit" class="btn btn-info" title="view_company"><i class="material-icons">search</i></button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('edit_company') }}" method="POST">
                            @csrf
                            <input name="id" type="hidden" value="{{$company->id}}">
                            <button type="submit" class="btn btn-info" title="edit_company"><i class="material-icons">redo</i></button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('delete_company') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input name="id" type="hidden" value="{{$company->id}}">
                            <button type="submit" class="btn btn-danger" title="delete_company"><i class="material-icons">delete</i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection
