<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Title;
use Illuminate\Http\Request;
use App\Models\Employee;

class TitleController extends Controller
{
    public function index()
    {  
        $title = Title::all();
        $employee = Employee::all();
        return view('title/index', compact('title','employee'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('title/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
    		'title_name' => ['required', 'unique:Titles'],
    	]);
 
        Title::create([
    		'title_name' => $request->title_name
    	]);
 
    	return redirect('/title');
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
        $title = Title::find($id);
        return view('title/edit', compact('title'));
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
        $request->validate([
    		'title_name' => 'required'
        ]);

        $title = [
            'title_name' => $request->title_name,
        ];
        Title::whereId($id)->update($title);
        return redirect('/title');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $title = Title::findorfail($id);
        $title->delete();
        return redirect('/title');
    }
}
