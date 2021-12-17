@extends('layouts.event')
@section('content')
<div class="image-title-centered">
    <img class="event-banner" id="event-banner" src="{{ asset($event->img_path) }}" alt="Image not found" />

    <h1 id="event-title" class="centered">{{ $event->name }}</h1>
    <h2 id="event-date" class="bottom-right">{{ date('d/m/Y', strtotime($event->event_date_start))}} - {{ date('d/m/Y', strtotime($event->event_date_end))}}</h2>
    <style nonce="{{ csp_nonce() }}">
        #event-title {
            color: {{ $event->title_color }};
            display: {{ $event->display_title }};
        }
        #event-date {
            color: {{ $event->title_color }};
            display: {{ $event->display_title }};
        }
    </style>
</div>
<div class="container container-content">
    <h2>{{ old('name') ?? $event->name ?? 'Preview Title'}}</h2>
    <p id="event-para-1">{!! $event->paraBody1 ?? '' !!}</p>
    <p id="event-para-2">{!! $event->paraBody2 ?? '' !!}</p>
    <p id="event-para-3">{!! $event->paraBody3 ?? '' !!}</p>
    <p id="event-para-4">{!! $event->paraBody4 ?? '' !!}</p>
</div>

<script nonce="{{ csp_nonce() }}">
    let error_image = document.getElementById("event-banner")
    error_image.onerror = function(event) {
            this.onerror=null;
            this.src="{{ asset('storage/preview/preview-image.jpg') }}";
    }
</script>
@endsection