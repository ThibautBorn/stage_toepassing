
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
    <h3>nieuwe inzending geregistreerd</h3>
    <p><b>{{$company->name}}</b> {{$company->department}} heeft het stage mogelijkheden ingediend. u kunt <a href="http://localhost/stage/public/login">hier</a> naar de toepassing gaan.</p>
    <p>
        Dit is een automatisch gegenereerde email. U hoeft hier niet op te antwoorden.
    </p>
</div>
</body>
</html>
