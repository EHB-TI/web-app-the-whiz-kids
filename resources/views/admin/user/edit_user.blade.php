@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit {{ __($user->name) }}</div>


            <div class="card-body">
                <form method="POST" action="{{ route('admin.edit-user-submit', $user->id) }}">
                    @csrf
                    <input name="id" type="hidden" value={{ $user->id }}>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Select role</label>
                        <div class="col-md-6">
                            <select class="form-control" id="role" name="role">
                                @if (old('_token') !== null))
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : ''}}>Admin</option>
                                <option value="editor" {{ old('role') == 'editor' ? 'selected' : ''}}>Editor</option>
                                <option value="viewer" {{ old('role') == 'viewer' ? 'selected' : ''}}>Viewer</option>
                                @else
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : ''}}>Admin</option>
                                <option value="editor" {{ $user->role == 'editor' ? 'selected' : ''}}>Editor</option>
                                <option value="viewer" {{ $user->role == 'viewer' ? 'selected' : ''}}>Viewer</option>
                                @endif
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

                                @if (old('_token') !== null))
                                <option value="{{ $group->id }}" {{ old('group') == $group->id ? 'selected' : ''}}>{{ $group->name }}</option>
                                @else
                                <option value="{{ $group->id }}" {{ $user->group_id == $group->id ? 'selected' : ''}}>{{ $group->name }}</option>
                                @endif
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
                                {{ __('Make Changes') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection