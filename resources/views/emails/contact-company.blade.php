
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        td {
            border-left: 1px solid black;
            border-right: 1px solid black;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
<div class="container">
<h3>Dank u voor uw inzending</h3>
<p>U hebt succesvol de stage(s) voor uw bedrijf <b>{{$company->name}}</b>ingediend! De UCLL zal binnenkort contact opnemen voor deze verder te bespreken.</p>
<p>
    Dit is een automatisch gegenereerde email. U hoeft hier niet op te antwoorden.
</p>
    <p>Indien u toch vragen/opmerkingen heeft over uw inzending kan u ons team contacteren op info@ucll_stages.com</p>
    <br>
    <br>
<p>
    Hieronder kan u een overzicht vinden van uw inzending:
</p>
    <table>
        <thead>
        <tr>
            <th width="20%">stage titel</th>
            <th width="25%">description</th>
            <th width="25%">profiel</th>
            <th width="15%">mentor naam</th>
            <th width="15%">mentor functie</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($internships as $internship)
            <tr align="center">
                <td>{{$internship->title}}</td>
                <td>{{$internship->description}}</td>
                <td>{{$internship->wanted_profile}}</td>
                <td>{{$internship->mentor_name}}</td>
                <td>{{$internship->mentor_function}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
