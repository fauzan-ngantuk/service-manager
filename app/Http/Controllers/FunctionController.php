<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Model
use App\Model\Application;
use App\Model\Functions;

class FunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data_app = Application::all();
        $data_fucntios = Functions::with(['application'])->where('id_application', $request->id_app)->get();
        return view('pages.function.index')->with('data', ['applications' => $data_app, 'functions' => $data_fucntios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Application::all();
        return view('pages.function.create')->with('applications', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $function = new Functions;
        $function->id_application = $request->id_application;
        $function->code = $request->code;
        $function->name = $request->name;
        $function->save();
        return redirect('/function');
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
        $data_func = Functions::find($id);
        $data_app = Application::all();
        $data = ['function' => $data_func, 'applications' => $data_app];
        return view('pages.function.edit')->with('data', $data);
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
        $function = Functions::find($id);
        $function->name = $request->name;
        $function->save();
        return redirect('/function');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $function = Functions::find($id);
        $function->delete();
        return redirect('/function');
    }

    public function showByIdApp(Request $request)
    {
        $data = Functions::with(['application'])->where('id_application', $request->id_app)->get();
        return view('pages.function.index')->with('functions', $data);
    }
}
