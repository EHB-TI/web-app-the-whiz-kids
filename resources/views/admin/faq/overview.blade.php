@extends('layouts.admin')
@section('content')
<div class="create">
    <a class="btn btn-primary" href="{{ route('admin.categories.create') }}" role="button">Categorie Toevoegen</a>
</div>
<div class="edit">
    @foreach ($data as $questionCategory)
    <div class="category">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $questionCategory->name }}</h4>
                <div class="button">
                    <a href="{{ route('admin.questions.create', $questionCategory->id) }}" class="btn btn-success">Add Question</a>
                </div>
                <div class="button">
                    <a href="{{ route('admin.categories.edit', $questionCategory->id) }}" class="btn btn-primary">Edit</a>
                </div>
                <div class="button">
                    <form action="{{ route('admin.categories.destroy', $questionCategory->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this category, it will also delete all questions!?')" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="questions">
            @foreach ($questionCategory->questions as $question)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $question->question }}</h5>
                    <p class="card-text">{{ $question->answer }}</p>
                    <div class="button">
                        <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                    <div class="button">
                        <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this question?')" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection