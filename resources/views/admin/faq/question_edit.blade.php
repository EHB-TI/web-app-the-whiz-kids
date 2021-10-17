@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Update question') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.questions.update', $question->id) }}">
                    {{ method_field('PUT') }}
                    @csrf
                    <input name="question_category_id" type="hidden" value={{ $question->question_category_id }}>
                    <div class="form-group row">
                        <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

                        <div class="col-md-6">
                            <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') ?? $question->question ?? '' }}" required>

                            @error('question')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Answer') }}</label>

                        <div class="col-md-6">
                            <textarea class="form-control  @error('answer') is-invalid @enderror" id="answer" name="answer" rows="3" maxlength="2048" required>{{ old('answer') ?? $question->answer ?? '' }}</textarea>
                            @error('answer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Question') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection