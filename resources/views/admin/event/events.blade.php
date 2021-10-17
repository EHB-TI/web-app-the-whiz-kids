@extends('layouts.admin')
@section('content')
<div class="create">
    @if (auth()->user()->role == "admin" || auth()->user()->role == "editor")
    <a class="btn btn-primary" href="{{ route('admin.create') }}" role="button">Toevoegen</a>
    @else
    <a class="btn btn-primary disabled" href="{{ route('admin.create') }}" role="button" aria-disabled="true">Toevoegen</a>
    @endif
</div>
<div class="edit">
    @foreach ($events as $event)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $event->name }}</h5>
            <p class="card-text">{{ $event->desc_short }}</p>
            <p class="card-text">Orginised by: 
            <?php 
            $json = json_decode($event->groups);
            echo implode(", ", array_map(function($obj) { return $obj->name; }, $json));
            ?>
            </p>
            <p class="card-text">{{ $event->visibility == true ? "Event zichbaarheid: Zichtbaar": "Event zichbaarheid: Onzichtbaar" }}</p>
            @if (auth()->user()->role == "admin" || auth()->user()->role == "editor")
            <div class="button">
                <a href="{{ route('admin.edit', $event->id) }}" class="btn btn-primary">Edit</a>
            </div>
            <div class="button">
                <form action="{{ route('admin.delete-event', $event->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete: {{ $event->name }}?')" class="btn btn-danger">Delete</button>
                </form>
            </div>
            @else
            <div class="button">
                <button type="submit" class="btn btn-primary" disabled>Edit</button>
            </div>
            <div class="button">
                    <button type="submit" class="btn btn-danger" disabled>Delete</button>
                </form>
            </div>
            @endif

            <div class="event-extra-info">
                <p class="card-text"><small class="text-muted">
                        Event Date: {{ date('d/m/Y', strtotime($event->event_date_start)) }} - {{ date('d/m/Y', strtotime($event->event_date_end)) }}
                        @if ($event->created_by == $event->updated_by)
                        <br>Created by: {{ $event->created_by }}
                        @else
                        <br>Created by: {{ $event->created_by }}<br>Updated by: {{ $event->updated_by }}
                        @endif
                    </small>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection