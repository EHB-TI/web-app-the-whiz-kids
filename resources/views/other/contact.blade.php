@extends('layouts.master')
@section('content')
@include('partials.about-header')
<form method="POST" action="{{ route('content.contact.store') }}">
    @csrf
    <div class="form-group">
        <label for="name">Full Name*</label>
        <input type="text" class="form-control" id="name" name="name" maxlength="256" value="{{ old('name') ?? '' }}" required>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="organisation">Organisation*</label>
        <input type="text" class="form-control" id="organisation" name="organisation" maxlength="256" value="{{ old('organisation') ?? '' }}" required>
        @error('organisation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email address*</label>
        <input type="email" class="form-control" id="email" name="email" maxlength="256" value="{{ old('email') ?? '' }}" required>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Description*</label>
        <textarea class="form-control" id="description" name="description" rows="3" maxlength="2048" required>{{ old('description') ?? '' }}</textarea>
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Send</button>
</form>
@endsection