@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Register a new user') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.add-user-submit') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Select role</label>
                        <div class="col-md-6">
                            <select class="form-control" id="role" name="role">
                                @if (auth()->user()->role == "super_admin")
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : ''}}>Admin</option>
                                @endif
                                <option value="editor" {{ old('role') == 'editor' ? 'selected' : ''}}>Editor</option>
                                <option value="viewer" {{ old('role') == 'viewer' ? 'selected' : ''}}>Viewer</option>
                            </select>

                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="group" class="col-md-4 col-form-label text-md-right">Select group</label>
                        <div class="col-md-6">
                            <select class="form-control" id="group" name="group">
                                @foreach ($groups as $group)
                                <option value="{{ $group->id }}" {{ old('group') == $group->id ? 'selected' : ''}}>{{ $group->name }}</option>
                                @endforeach
                            </select>

                            @error('group')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add User') }}
                            </button>
                        </div>
                    </div>

                    @error('emailService')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </form>
            </div>
        </div>
    </div>
</div>

@endsection