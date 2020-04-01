<table>
    <thead>
    <tr>
        <th>stage</th>
        <th>beschrijving</th>
        <th>afstudeerrichtingen</th>
        <th>bedrijf</th>
        <th>departement</th>
        <th>straat</th>
        <th>gemeente</th>
        <th>naam stage admin</th>
        <th>functie stage admin</th>
        <th>mail stage admin</th>
        <th>nummer stage admin</th>
        <th>naam stage mentor</th>
        <th>functie stage mentor</th>
        <th>mail stage mentor</th>
        <th>nummer stage mentor</th>
        <th>gewenst profiel</th>
        <th>extra informatie</th>
        <th>kan in eerste semester gedaan worden</th>
        <th>kan gecombineerd worden met afstudeerproject</th>
    </tr>
    </thead>
    <tbody>
    @foreach($internships as $internship)
        <tr>
            <td>{{$internship->title}}</td>
            <td>{{$internship->description}}</td>
            <td>
                @foreach($internship->options as $option)
                    {{$option->field_of_study}} - {{$option->option_name}}
                @endforeach
            </td>
        @foreach($companies as $company)
                @if($company->id === $internship->company_id)
                    <td>{{$company->name}}</td>
                    <td>{{$company->department}}</td>
                    <td>{{$company->street}} {{$company->number}}</td>
                    <td>{{$company->municipality}} {{$company->zipcode}}</td>
                    <td>{{$company->admin_name}}</td>
                    <td>{{$company->admin_function}}</td>
                    <td>{{$company->admin_mail}}</td>
                    <td>{{$company->admin_phone}}</td>
                @endif
        @endforeach
            <td>{{$internship->mentor_name}}</td>
            <td>{{$internship->mentor_function}}</td>
            <td>{{$internship->mentor_mail}}</td>
            <td>{{$internship->mentor_phone}}</td>
            <td>{{$internship->wanted_profile}}</td>
            @if($internship->first_semester_possibility === null)
                <td>/</td>
            @else
                <td>{{$internship->additional_information}}</td>
            @endif
            @if($internship->first_semester_possibility === 1)
                <td>Ja</td>
            @else
                <td>Nee</td>
            @endif
            @if($internship->project_possibility === 1)
                <td>Ja</td>
            @else
                <td>Nee</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
