@extends('layouts.master')
@section('content')

<div id='calendar'></div>
<link rel="stylesheet" href="{{ asset('storage/css/calendar/fullcalendar.min.css') }}">
<script src="{{ asset('storage/js/calendar/moment.min.js') }}"></script>
<script src="{{ asset('storage/js/calendar/jquery.min.js') }}"></script>
<script src="{{ asset('storage/js/calendar/fullcalendar.min.js') }}"></script>
<script nonce="ab7ccad4709e4606810311857087d8d5">
    jQuery(document).ready(function($) {
        events = {!!json_encode($data, JSON_HEX_TAG) !!}
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            events: events,
        });
    });
</script>

@endsection