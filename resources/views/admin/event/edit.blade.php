@extends('layouts.edit-create')
@section('content')

@include('partials.event-header')

<div class="edit-container">
    <div id="info-preview">
        <form method="POST" action="{{ route('admin.edit', $event->id) }}" enctype="multipart/form-data">
            <div id="edit-form" class="extra-form">
                @include('partials.edit-create')
            </div>
            <div class="event-preview" id="event-preview">
                <div class="form-group">
                    <label for="bannerFile">Upload Banner File (save changes to preview)</label>
                    <input type="file" class="form-control" id="bannerFile" name="event_banner">

                    @error('event_banner')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                @if (old('display_name') == 1)
                <div class="form-group" id="colorGroup">
                    <label for="titleColor" id="colorDisplay">Title & Date Color</label>
                    <input id="titleColor" class="form-control" name="title_color" type="text" value="{{ old('title_color') ?? $event->title_color ?? 'rgb(0, 0, 0)' }}" />
                </div>
                <style nonce="{{ csp_nonce() }}">
                    #colorGroup {
                        display: block;
                    }
                </style>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="displayTitle" name="display_title" value="1" checked>
                    @elseif ($event->display_title ?? false)
                    @if ($event->display_title == "block")
                    <div class="form-group" id="colorGroup">
                        <label for="titleColor" id="colorDisplay">Title & Date Color</label>
                        <input id="titleColor" class="form-control" name="title_color" type="text" value="{{ old('title_color') ?? $event->title_color ?? 'rgb(0, 0, 0)' }}" />
                    </div>
                    <style nonce="{{ csp_nonce() }}">
                        #colorGroup {
                            display: block;
                        }
                    </style>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="displayTitle" name="display_title" value="1" checked>
                        @else
                        <div class="form-group" id="colorGroup">
                            <label for="titleColor" id="colorDisplay">Title & Date Color</label>
                            <input id="titleColor" class="form-control" name="title_color" type="text" value="{{ old('title_color') ?? $event->title_color ?? 'rgb(0, 0, 0)' }}" />
                        </div>
                        <style nonce="{{ csp_nonce() }}">
                            #colorGroup {
                                display: none;
                            }
                        </style>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="displayTitle" name="display_title" value="1">
                            @endif
                            @else
                            <div class="form-group" id="colorGroup">
                                <label for="titleColor" id="colorDisplay">Title & Date Color</label>
                                <input id="titleColor" class="form-control" name="title_color" type="text" value="{{ old('title_color') ?? $event->title_color ?? 'rgb(0, 0, 0)' }}" />
                            </div>
                            <style nonce="{{ csp_nonce() }}">
                                #colorGroup {
                                    display: none;
                                }
                            </style>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="displayTitle" name="display_title" value="1">
                                @endif
                                <label class="form-check-label" for="displayTitle">
                                    Display Title and Date on Event Banner (check preview for results)
                                </label>
                            </div>
                            @include('partials.event-preview')
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <div class="button">
                                <a href="{{ route('admin.events') }}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
        </form>

        <div id="visibility">
            <div class="extra-form">
                <form method="POST" action="{{ route('admin.event.visibility') }}">
                    @csrf
                    <input name="id" type="hidden" value={{ $event->id }}>
                    <label class="my-1 mr-2" for="eventVisibility">Event Visibility</label>
                    <select class="custom-select my-1 mr-sm-2" id="eventVisibility" name="visibility">
                        @if (old('_token') !== null))
                        <option value=false {{ old('visibility') == false ? 'selected' : ''}}>Event is onzichtbaar</option>
                        <option value=true {{ old('visibility') == true ? 'selected' : ''}}>Event is zichtbaar</option>
                        @else
                        <option value=false {{ $event->visibility == false ? 'selected' : ''}}>Event is onzichtbaar</option>
                        <option value=true {{ $event->visibility == true ? 'selected' : ''}}>Event is zichtbaar</option>
                        @endif
                    </select>
                    @error('visibility')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <button type="submit" class="btn btn-primary">Change Visibility</button>
                </form>
            </div>

            @if(auth()->user()->role == "admin" || auth()->user()->role == "super_admin")
            <div class="extra-form">
                <form action="{{ route('admin.event.groups') }}" method="post">
                    @csrf
                    <input name="id" type="hidden" value={{ $event->id }}>
                    <label for="">Organisatoren: </label>
                    @foreach ($groups as $group)
                    <div class="form-check">
                        <?php
                        $ids = array();
                        foreach ($event->groups as $controller) {
                            array_push($ids, $controller->id);
                        }
                        ?>
                        <input type="checkbox" class="form-check-input" id="group-{{ $group->name }}" name="groups[]" value="{{ $group->id }}" {{ in_array($group->id, $ids) ? "checked":"" }}>
                        <label for="group-{{ $group->name }}" class="form-check-label">{{ $group->name }}</label>
                    </div>
                    @endforeach
                    @error('groups')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <button type="submit" class="btn btn-primary">Save groups</button>
                </form>
            </div>
            @endif
        </div>

        <div id="ticket">
        </div>
        <style nonce="{{ csp_nonce() }}">
            #ticket {
                display: none;
            }

            #event-preview {
                display: none;
            }

            #visibility {
                display: none;
            }
        </style>
    </div>

    <!-- load in js -->
    <script src="{{ asset('storage/js/event.js') }}"></script>
    @endsection