@extends('layouts.admin')
@section('content')
<div class="create">
    <a class="btn btn-primary" href="{{ route('admin.add-user') }}" role="button">Toevoegen</a>
</div>

<div class="edit">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Group</th>
                <th scope="col">Delete</th>
                <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>{{ $user->group_name }}</td>
                @if ($user->id != auth()->user()->id && auth()->user()->role == "super_admin")
                <td>
                    <div class="button">
                        <form action="{{ route('admin.delete-user', $user->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" id="{{ $user->name }}" class="btn btn-danger delete-button">Delete</button>
                        </form>
                    </div>
                </td>
                <td>
                    <div class="button">
                        <a href="{{ route('admin.edit-user', $user->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </td>
                @elseif ($user->id != auth()->user()->id && $user->role != "admin" && $user->role != "super_admin")
                <td>
                    <div class="button">
                        <form action="{{ route('admin.delete-user', $user->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" id="{{ $user->name }}" class="btn btn-danger delete-button">Delete</button>
                        </form>
                    </div>
                </td>
                <td>
                    <div class="button">
                        <a href="{{ route('admin.edit-user', $user->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </td>
                @else
                <td>
                    <div class="button">
                        <button type="submit" class="btn btn-danger" disabled>Delete</button>
                    </div>
                </td>
                <td>
                    <div class="button">
                        <button type="submit" class="btn btn-primary" disabled>Edit</button>
                    </div>
                </td>
                @endif
            </tr>
            @endforeach
            <script nonce="4631e09d23894382bac5f93234be3aec">
                let deleteButtons = document.getElementsByClassName("delete-button")
                for (let deleteButton of deleteButtons){
                    deleteButton.addEventListener("click", function(event) {
                        if (!confirm(`Are you sure you want to delete: ${deleteButton.id}?`)) event.preventDefault();
                    })
                }
            </script>
        </tbody>
    </table>
</div>
@endsection