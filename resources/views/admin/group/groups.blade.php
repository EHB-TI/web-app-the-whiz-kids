@extends('layouts.admin')
@section('content')
<div class="create">
    <a class="btn btn-primary" href="{{ route('admin.add-group') }}" role="button">Toevoegen</a>
</div>

<div class="edit">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Group Name</th>
                <th scope="col">Members</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
            <tr>
                <td>{{ $group->name }}</td>
                <td>
                    {{ implode(', ', $group->members) }}
                </td>
                <td>
                    <div class="button">
                        @if ($group->id == auth()->user()->group_id || $group->name == "Unassigned")
                        <button type="submit" class="btn btn-danger" disabled>Delete</button>
                        @else
                        <form action="{{ route('admin.delete-group', $group->id)  }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" id="{{ $group->name }}" class="btn btn-danger delete-button">Delete</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
            <script nonce="{{ csp_nonce() }}">
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