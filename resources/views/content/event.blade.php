@extends('layouts.event')
@section('content')
<div class="image-title-centered">
    <img class="event-banner" id="event-banner" src="{{ asset($event->img_path) }}" alt="Image not found" />

    <h1 class="centered" style="color:{{ $event->title_color }}; display:{{ $event->display_title }}">{{ $event->name }}</h1>
    <h2 id="event-date" style="color:{{ $event->title_color }}; display:{{ $event->display_title }}" class="bottom-right">{{ date('d/m/Y', strtotime($event->event_date_start))}} - {{ date('d/m/Y', strtotime($event->event_date_end))}}</h2>
</div>
<div class="container container-content">
    <h2>{{ old('name') ?? $event->name ?? 'Preview Title'}}</h2>
    <p id="event-para-1">{!! $event->paraBody1 ?? '' !!}</p>
    <p id="event-para-2">{!! $event->paraBody2 ?? '' !!}</p>
    <p id="event-para-3">{!! $event->paraBody3 ?? '' !!}</p>
    <p id="event-para-4">{!! $event->paraBody4 ?? '' !!}</p>
</div>

<script nonce="028b2129f1304a25a8b81cb8787fb495">
    let error_image = document.getElementById("event-banner")
    error_image.onerror = function(event) {
            this.onerror=null;
            this.src="{{ asset('storage/preview/preview-image.jpg') }}";
    }
</script>
@endsection