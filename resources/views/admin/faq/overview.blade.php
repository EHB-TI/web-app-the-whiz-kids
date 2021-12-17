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
                        <button type="submit" class="btn btn-danger delete-button-cat">Delete</button>
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
                            <button type="submit" class="btn btn-danger delete-button-ques">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
    <script nonce="{{ csp_nonce() }}">
        let deleteButtonsCat = document.getElementsByClassName("delete-button-cat")
        for (let deleteButton of deleteButtonsCat){
            deleteButton.addEventListener("click", function(event) {
                if (!confirm('Are you sure you want to delete this category, it will also delete all questions!?')) event.preventDefault();
            })
        }
        let deleteButtonsQues = document.getElementsByClassName("delete-button-ques")
        for (let deleteButton of deleteButtonsQues){
            deleteButton.addEventListener("click", function(event) {
            	if (!confirm('Are you sure you want to delete this question?')) event.preventDefault();
            })
        }
    </script>
</div>
@endsection