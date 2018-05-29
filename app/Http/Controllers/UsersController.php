<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Model
use App\Model\Users;
use App\Model\Functions;
use App\Model\Application;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Users::all();
        return view('pages.users.index')->with('users', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_app = Application::all();
        $data_func = Functions::all();
        $data = ['applications' => $data_app, 'functions' => $data_func];
        return view('pages.users.create')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new Users;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->secret = str_random(10);
        $user->role = $request->role;
        switch ($request->role) {
            case 'guest':
                $user->application_grant = $request->function;
                break;
            default:
                $user->application_grant = $request->application;
                break;
        }
        $user->save();
        return redirect('/users');
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
        $data_user = Users::find($id);
        $data_app = Application::all();
        $data_func = Functions::all();
        $data = ['user' => $data_user, 'applications' => $data_app, 'functions' => $data_func];
        return view('pages.users.edit')->with('data', $data);
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
        $user = Users::find($id);
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        switch ($request->role) {
            case 'guest':
                $user->application_grant = $request->function;
                break;
            default:
                $user->application_grant = $request->application;
                break;
        }
        $user->save();
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Users::find($id);
        $user->delete();
        return redirect('/users');
    }
}
