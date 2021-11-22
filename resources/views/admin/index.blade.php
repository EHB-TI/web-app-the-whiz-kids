@extends('layouts.admin')
@section('content')

    <h1 class="mt-4">Aan de slag</h1>

    @if($alert ?? false)
        <div class="alert alert-danger">
            Omwille van veiligheidsredenen, is de remember-me functie uitgeschakeld voor admins!
        </div>
    @endif

    <p>Aanmaken van een nieuw event is eenvoudig, ga naar de event tab aan de linker kant en druk dan rechts bovenaan op
        "Toevoegen".</p>
    <p>Een nieuwe locatie aanmaken kan tijdens het aanmaken van een event of door naar de tab "locatie" te gaan en
        wederom rechts bovenaan op "Toevoegen" te drukken.</p>
@endsection
