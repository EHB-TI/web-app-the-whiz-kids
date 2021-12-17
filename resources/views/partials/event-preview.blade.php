    <div class="image-title-centered">
        <img id="event-banner"  class="event-banner" src="{{ asset($event->img_path) }}" alt="Image not found" />
        <h1 id="event-title" class="centered" style="color:{{ old('title_color') ?? $event->title_color ?? 'rgb(255,255,255)' }}; display:{{ $event->display_title ?? 'block' }}">{{ old('name') ?? $event->name ?? 'Preview Title'}}</h1>
        @if (old('_token') !== null)
        <h2 id="event-date" class="bottom-right" style="color:{{ old('title_color') ?? $event->title_color ?? 'rgb(255,255,255)' }}; display:{{ $event->display_title ?? 'block' }}">{{ date('d/m/Y', strtotime(old('event_date_start'))) }} - {{ date('d/m/Y', strtotime(old('event_date_end'))) }}</h2>
        @else
        <h2 id="event-date" class="bottom-right" style="color:{{ old('title_color') ?? $event->title_color ?? 'rgb(255,255,255)' }}; display:{{ $event->display_title ?? 'block' }}">{{ date('d/m/Y', strtotime($event->event_date_start ?? date('Y-m-d\TH:i'))) ?? 'Preview Date' }} - {{ date('d/m/Y', strtotime($event->event_date_end ?? date('Y-m-d\TH:i'))) ?? 'Preview Date' }}</h2>
        @endif
    </div>
    <div class="container-content">
        <h3 id="event-subtitle">{{ old('name') ?? $event->name ?? 'Preview Title'}}</h3>
        <p id="event-para-1">{!! old('paraBody1') ?? $event->paraBody1 ?? '' !!}</p>
        <p id="event-para-2">{!! old('paraBody2') ?? $event->paraBody2 ?? '' !!}</p>
        <p id="event-para-3">{!! old('paraBody3') ?? $event->paraBody3 ?? '' !!}</p>
        <p id="event-para-4">{!! old('paraBody4') ?? $event->paraBody4 ?? '' !!}</p>
    </div>
    <script nonce="b11d7af672c54a8ab27420e4739a988a">
        let error_image = document.getElementById("event-banner")
        error_image.onerror = function(event) {
            this.onerror=null;
            this.src="{{ asset('storage/preview/preview-image.jpg') }}";
        }
    </script>
</div>