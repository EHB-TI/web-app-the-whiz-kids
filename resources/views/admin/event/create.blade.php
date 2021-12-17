@extends('layouts.edit-create')
@section('content')

<div class="edit-container">
    <form method="POST" action="{{ route('admin.create') }}" enctype="multipart/form-data">
        @include('partials.edit-create')
        <div class="form-group" id="colorGroup">
            <label for="titleColor" id="colorDisplay">Title & Date Color</label>
            <input id="titleColor" class="form-control" name="title_color" type="text" value="{{ old('title_color') ?? $event->title_color ?? 'rgb(0, 0, 0)' }}" />
        </div>
        <style nonce="{{ csp_nonce() }}">
            #colorGroup {
                display: none;
            }
            #colorDisplay {
                color: {{ old('title_color') ?? $event->title_color ?? 'rgb(0,0,0)' }};
            }
        </style>
        <div class="form-check" hidden>
            <input class="form-check-input" type="checkbox" value="" id="displayTitle" name="display_title" value="1">
            <label class="form-check-label" for="displayTitle">
                Display Title and Date on Event Banner (check preview for results)
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Create Event</button>
        <div class="button">
            <a href="{{ route('admin.events') }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
</div>

@endsection