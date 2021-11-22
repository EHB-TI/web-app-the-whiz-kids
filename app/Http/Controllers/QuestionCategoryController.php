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
        $this->logger->info('Get view of the index page for the categories');

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
        $this->logger->info('Get create view to add categories');
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
        $this->logger->info('Validate Post data for new category');
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:256'],
        ]);

        if ($validator->fails()) {
            $this->logger->error('Failed on Validation Post data');
            return redirect()->route('admin.questions.create', $request->question_category_id)
                ->withErrors($validator)
                ->withInput();
        }

        QuestionCategory::create([
            'name' => $request['name'],
        ]);

        $this->logger->info('Category succesfully added');

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
        $this->logger->info('Get view to edit categories');
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
        $this->logger->info('Update an existing category');
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:256'],
        ]);

        if ($validator->fails()) {
            $this->logger->error('Update failed on validation Post data');
            return redirect()->route('admin.questions.create', $request->question_category_id)
                ->withErrors($validator)
                ->withInput();
        }

        QuestionCategory::find($category->id)->update(['name' => $request->name]);

        $this->logger->info('Category succesfully added');

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
        $this->logger->info('Delete a category');
        $questions = QuestionCategory::find($category->id)->questions;
        foreach ($questions as $question) {
            $question->delete();
        }
        $category->delete();

        $this->logger->info('Succesfully deleted a category');
        return redirect()->route('admin.categories.index')
            ->with('status', 'Category succesfully deleted!');
    }
}
