@csrf

<input name="id" type="hidden" value={{ $event->id ?? '' }}>
<div class="form-group">
    <label for="eventName">Event Naam</label>
    <input type="text" class="form-control" id="eventName" placeholder="" name="name" value="{{ old('name') ?? $event->name ?? '' }}" required>

    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label for="eventDescS">Event beschrijving (kort)</label>
    <input type="text" class="form-control" id="eventDescS" name="desc_short" value="{{ old('desc_short') ?? $event->desc_short ?? '' }}" required>

    @error('desc_short')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="paraBody1">Event beschrijving: Paragraaf 1</label>
    <textarea class="form-control" id="paraBody1" rows="3" name="paraBody1" required>{{ old('paraBody1') ?? $event->paraBody1 ?? '' }}</textarea>
    @error('paraBody1')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div id="extraParagraphs">

    @if (old('_token') !== null)
    @if (old('paraBody4') !== null)
    <div class="form-group">
        <label for="paraBody2">Event beschrijving: Paragraaf 2</label>
        <textarea class="form-control" id="paraBody2" rows="3" name="paraBody2">{{ old('paraBody2') ?? '' }}</textarea>
        @error('paraBody2')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="paraBody3">Event beschrijving: Paragraaf 3</label>
        <textarea class="form-control" id="paraBody3" rows="3" name="paraBody3">{{ old('paraBody3') ?? '' }}</textarea>
        @error('paraBody3')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="paraBody4">Event beschrijving: Paragraaf 4</label>
        <textarea class="form-control" id="paraBody4" rows="3" name="paraBody4">{{ old('paraBody4') ?? '' }}</textarea>
        @error('paraBody4')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @elseif (old('paraBody3') !== null)
    <div class="form-group">
        <label for="paraBody2">Event beschrijving: Paragraaf 2</label>
        <textarea class="form-control" id="paraBody2" rows="3" name="paraBody2">{{ old('paraBody2') ?? '' }}</textarea>
        @error('paraBody2')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="paraBody3">Event beschrijving: Paragraaf 3</label>
        <textarea class="form-control" id="paraBody3" rows="3" name="paraBody3">{{ old('paraBody3') ?? '' }}</textarea>
        @error('paraBody3')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @elseif (old('paraBody2') !== null)
    <div class="form-group">
        <label for="paraBody2">Event beschrijving: Paragraaf 2</label>
        <textarea class="form-control" id="paraBody2" rows="3" name="paraBody2">{{ old('paraBody2') ?? '' }}</textarea>
        @error('paraBody2')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @endif

    @elseif ($event ?? null !== null)
    @if ($event->paraBody2 !== null)
    <div class="form-group">
        <label for="paraBody2">Event beschrijving: Paragraaf 2</label>
        <textarea class="form-control" id="paraBody2" rows="3" name="paraBody2">{{ $event->paraBody2 ?? '' }}</textarea>
    </div>
    @endif
    @if ($event->paraBody3 !== null)
    <div class="form-group">
        <label for="paraBody3">Event beschrijving: Paragraaf 3</label>
        <textarea class="form-control" id="paraBody3" rows="3" name="paraBody3">{{ $event->paraBody3 ?? '' }}</textarea>
    </div>
    @endif
    @if ($event->paraBody4 !== null)
    <div class="form-group">
        <label for="paraBody4">Event beschrijving: Paragraaf 4</label>
        <textarea class="form-control" id="paraBody4" rows="3" name="paraBody4">{{ $event->paraBody4 ?? '' }}</textarea>
    </div>
    @endif
@endif
</div>
<button class="btn btn-primary" id="addParagraph">Add Paragraph</button>
<script src="{{ asset('storage/js/addParagraph.js') }}"></script>

<div class="form-group">
    <label for="urlEvent">Url to event social media page</label>
    <input type="url" class="form-control" id="urlEvent" placeholder="" name="url_event" value="{{ old('url_event') ?? $event->url_event ?? '' }}" >

    @error('url_event')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-row">
    <div class="col-auto">
        <label for="eventDateStart">Datum Begin</label>
        @if (old('_token') !== null)
        <input type="datetime-local" class="form-control" id="eventDateStart" placeholder="" name="event_date_start" value="{{ old('event_date_start') }}" required>
        @else
        <input type="datetime-local" class="form-control" id="eventDateStart" placeholder="" name="event_date_start" value="{{ date('Y-m-d\TH:i', strtotime($event->event_date_start ?? date('Y-m-d\TH:i'))) }}" required>
        @endif

        @error('event_date_start')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="col-auto">
        <label for="eventDateEnd">Datum Einde</label>
        @if (old('_token') !== null)
        <input type="datetime-local" class="form-control" id="eventDateEnd" placeholder="" name="event_date_end" value="{{ old('event_date_end') }}" required>
        @else
        <input type="datetime-local" class="form-control" id="eventDateEnd" placeholder="" name="event_date_end" value="{{ date('Y-m-d\TH:i', strtotime($event->event_date_end ?? date('Y-m-d\TH:i'))) }}" required>
        @endif

        @error('event_date_end')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>