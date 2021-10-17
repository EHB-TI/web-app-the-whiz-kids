<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class ContactController extends Controller
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
    public function create()
    {
        return view('other.contact');
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
            'name' => ['required', 'string', 'max:256'],
            'organisation' => ['required', 'string', 'max:256'],
            'email' => ['required', 'string', 'email', 'max:256'],
            'description' => ['required', 'string', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('content.contact.create')
                ->withErrors($validator)
                ->withInput();
        }

        $data = (object) [
            'name' => $request->name,
            'organisation' => $request->organisation,
            'description' => $request->description
        ];

        Mail::to('better.ge.tracker@gmail.com')->send(new SendMail($request->email, $data));

        return redirect()->route('content.index')
        ->with('status', 'Your form was succesfully sent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
