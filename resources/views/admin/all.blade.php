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
            <th width="20%">stage titel</th>
            <th width="15%">Naam mentor</th>
            <th width="5%">toon</th>
            <th width="5%">bewerk</th>
            <th width="5%">Verwijder</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($internships as $internship)
            <tr>
                <td>
                    @foreach($companies as $company)
                        @if($company->id === $internship->company_id)
                            <form action="{{ route('view_company') }}" method="GET">
                                @csrf
                                <input name="id" type="hidden" value="{{$company->id}}">
                                <button type="submit" class="btn btn-link" title="view_company"><h3>{{$company->name}}</h3></button>
                            </form>
                        @endif
                    @endforeach
                </td>
                <td>{{$internship->title}}</td>
                <td>{{$internship->mentor_name}}</td>
                <td>
                    <form action="{{ route('view_internship') }}" method="GET">
                        @csrf
                        <input name="id" type="hidden" value="{{$internship->id}}">
                        <button type="submit" class="btn btn-info" title="view_internship"><i class="material-icons">search</i></button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('edit_internship') }}" method="POST">
                        @csrf
                        <input name="id" type="hidden" value="{{$internship->id}}">
                        <button type="submit" class="btn btn-info" title="edit_internship"><i class="material-icons">redo</i></button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('delete_internship') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input name="id" type="hidden" value="{{$internship->id}}">
                        <button type="submit" class="btn btn-danger" title="delete_internship"><i class="material-icons">delete</i></button>
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

