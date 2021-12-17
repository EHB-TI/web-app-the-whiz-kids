@extends('layouts.master')
@section('content')

<h2 class="h2-title">Upcoming events</h2>
@foreach ($events as $event)
@if ($event->event_date_end >= date("Y-m-d"))
<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img class="card-img event-img" src="{{ asset($event->img_path) }}" alt="Image not found" />
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('content.event', $event->id) }}">{{ $event->name }}</a>
                </h5>
                <p class="card-text">{{ $event->desc_short }}</p>
                <p class="card-text"><small class="text-muted">Event Date: {{ date('d/m/Y', strtotime($event->event_date_start))}} - {{ date('d/m/Y', strtotime($event->event_date_end))}}</small></p>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach

<h2 class="h2-title">Passed Events</h2>
@foreach ($events->reverse() as $event)
@if ($event->event_date_end < date("Y-m-d"))
<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img class="card-img event-img" src="{{ asset($event->img_path) }}" alt="Image not found" />
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('content.event', $event->id) }}">{{ $event->name }}</a>
                </h5>
                <p class="card-text">{{ $event->desc_short }}</p>
                <p class="card-text"><small class="text-muted">Event Date: {{ date('d/m/Y', strtotime($event->event_date_start))}} - {{ date('d/m/Y', strtotime($event->event_date_end))}}</small></p>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
<script nonce="452de1949cc9487f96abaa61a336823b">
    let error_images = document.getElementsByClassName("event-img");
    for (let image of error_images) {
        image.onerror = function(event) {
            this.onerror=null;
            this.src="{{ asset('storage/preview/preview-image.jpg') }}";
        }
    };
</script>
@endsection