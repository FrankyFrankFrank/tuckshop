<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Record;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // If the user is logged in return the index view containing all records attached to the user
        // Otherwise, redirect to the login page
        if (auth()->user()) {

            $records = Record::where('user_id', auth()->user()->id)->orderBy('title', 'asc')->get();

            return view('records.index', ['records' => $records]);

        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('records.create');
    }

    /**
     * Store a new Record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Form input
        $this->validate($request, [
            'title' => 'required|string',
            'artist' => 'required|string',
            'year' => 'required|numeric',
            'label' => 'required|string',
        ]);

        // Create a new record
        $record = new Record([
            'title' => $request->input('title'),
            'artist' => $request->input('artist'),
            'year' => $request->input('year'),
            'label' => $request->input('label'),
        ]);

        // save the record for the currently authenticated user
        auth()->user()->records()->save($record);

        // Redirect to the records index page
        return redirect('/records');
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
        $record = Record::findOrFail($id);

        return view('records.edit', ['record' => $record]);
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
        // Validate Form input
        $this->validate($request, [
            'title' => 'nullable|string',
            'artist' => 'nullable|string',
            'year' => 'nullable|numeric',
            'label' => 'nullable|string',
        ]);

        $record = Record::findOrFail($id);

        if($record->userOwns(auth()->user())) {
            $record->update($request->intersect([
                'title',
                'artist',
                'year',
                'label'    
            ]));
            return redirect()->route('records.index');
        } else {
            return redirect()->route('records.index');
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Record::find($id);

        if ($record->userOwns(auth()->user())) {
            $record->delete();
        }
        
        return redirect('/records');
    }
}
