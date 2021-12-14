@extends('layouts.admin')
@section('content')
<div>
    <p>Name: {{$profile->name}}</p>
    <p>Role: {{$profile->role}}</p>
    <p>Group: {{$profile->group}}</p>
    <p>Email: {{$profile->email}}</p>
    <p><a href="{{ route('admin.profile.change-password') }}">Change Password</a></p>
    <p><a href="{{ route('admin.profile.download') }}">Ask account information</a></p>
    <p><a href="{{ route('admin.profile.delete') }}">Request to delete account</a></p>
    @error('deleteError')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('emailService')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
@endsection