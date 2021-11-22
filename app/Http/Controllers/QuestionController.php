<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($question_category_id)
    {
        return view('admin.faq.question_create', ['question_category_id' => $question_category_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validates request
        $validator = Validator::make($request->all(), [
            'question_category_id' => ['required', 'exists:question_categories,id'],
            'question' => ['required', 'string', 'max:256'],
            'answer' => ['required', 'string', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.questions.create', $request->question_category_id)
                ->withErrors($validator)
                ->withInput();
        }

        $id = Question::create([
            'question_category_id' => $request['question_category_id'],
            'question' => $request['question'],
            'answer' => $request['answer'],
        ])->id;

        $this->logger->info('Question created, id: '.$id);

        return redirect()->route('admin.categories.index')
        ->with('status', 'Question succesfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.faq.question_edit', ['question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {

        $validator = Validator::make($request->all(), [
            'question_category_id' => ['required', 'exists:question_categories,id'],
            'question' => ['required', 'string', 'max:256'],
            'answer' => ['required', 'string', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.questions.create', $request->question_category_id)
                ->withErrors($validator)
                ->withInput();
        }

        Question::find($question->id)->update(['question' => $request->question, 'answer' => $request->answer]);

        $this->logger->info('Question updated, id: '.$question->id);

        return redirect()->route('admin.categories.index')
        ->with('status', 'Question succesfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $id = $question->id;
        $question->delete();

        $this->logger->info('Question deleted, id: '.$id);

        return redirect()->route('admin.categories.index')
            ->with('status', 'Question succesfully deleted!');
    }
}
