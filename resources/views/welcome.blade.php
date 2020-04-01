@extends('layout')

@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @endauth
                </div>
            @endif
        </div>
        <div class="content">
            <h1>Stage project</h1>
            <p>Deze toepassing dient voor het indienen van stages voor de richting toegepaste informatica. U kan <a href="{{ route('company_form') }}">hier</a> uw stages registeren.</p>
            <p>Hoe gaat deze applicatie in zijn werk?</p>
            <ul>
                <li>1) geef enkele basisgegevens mee over uw bedrijf/dienst en de algemene verantwoordelijke voor de stages</li>
                <li>2) U wordt doorverwezen naar een stage formulier waar u gegevens voor minstens één stage moet meegeven  </li>
                <li>3) Vervolgens komt u op een overzichtspagina: hier kan u stages toevoegen, bewerken en/of verwijderen.</li>
                <li>4) Wanneer u klaar bent kunt u uw inzending definitief registeren.</li>
            </ul>
            <p><b>Opmerking:</b> Eenmaal ingezonden kunt u geen wijzigingen meer maken. Indien u achteraf toch nog aanpassingen wil maken, kan u contact opnemen met onze administrator:</p>
            <ul>
                <li><i class="material-icons">call</i> - 016/123123</li>
                <li><i class="material-icons">mail</i> - info@ucllstages.be</li>
            </ul>
            <button class="btn btn-primary" onclick="window.location='{{ route('company_form')}}'">
                start registratie
            </button>
        </div>
    </div>
@endsection

