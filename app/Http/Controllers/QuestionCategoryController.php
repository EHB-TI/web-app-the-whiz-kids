<?php

namespace App\Http\Controllers;

use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Route;

class QuestionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = QuestionCategory::all();
        
        foreach ($categories as  $category) {
            $questions = QuestionCategory::find($category->id)->questions;
            $category->questions = $questions;
        }

        if (Route::currentRouteName() == "admin.categories.index") {
            return view('admin.faq.overview', ['data' => $categories]);
        } else {
            return view('other.faq', ['data' => $categories]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.category_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:256'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.questions.create', $request->question_category_id)
                ->withErrors($validator)
                ->withInput();
        }

        QuestionCategory::create([
            'name' => $request['name'],
        ]);

        return redirect()->route('admin.categories.index')
        ->with('status', 'Category succesfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionCategory $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionCategory $category)
    {
        return view('admin.faq.category_edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionCategory $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:256'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.questions.create', $request->question_category_id)
                ->withErrors($validator)
                ->withInput();
        }

        QuestionCategory::find($category->id)->update(['name' => $request->name]);

        return redirect()->route('admin.categories.index')
        ->with('status', 'Category succesfully added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionCategory $category)
    {
        $questions = QuestionCategory::find($category->id)->questions;
        foreach ($questions as $question) {
            $question->delete();
        }
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('status', 'Category succesfully deleted!');
    }
}
