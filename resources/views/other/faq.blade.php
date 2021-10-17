@extends('layouts.master')
@section('content')
@include('partials.about-header')
@foreach ($data as $category)
    <h2>{{ $category->name }}</h2>
    @foreach ($category->questions as $question)
        <p><b>{{ $question->question }}</b></p>
        <p>{{ $question->answer }}</p>
    @endforeach
    <br>
@endforeach
@endsection