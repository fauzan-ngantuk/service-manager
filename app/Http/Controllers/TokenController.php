<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Model
use App\Model\Token;
use App\Model\Users;
use App\Model\Functions;
use App\Model\FunctionToken;

class TokenController extends Controller
{

    public function index(Request $request)
    {
        $data = Token::with(['user'])->get();
        return view('pages.token.index')->with('tokens', $data);
    }

    public function show($token_id)
    {
        $token = Token::find($token_id);
        $user = Users::find($token->id_user);
        $function_tokens = FunctionToken::where('id_token', $token_id)->get();
        switch ($user->role) {
            case 'admin':
                $functions = Functions::with(['application'])->orderBy('id_application')->get();
                break;
            case 'developer':
                $functions = Functions::with(['application'])->where('id_application', $user->application_grant)->orderBy('id_application')->get();
                break;
            case 'guest':
                $functions = Functions::with(['application'])->where('code', $user->application_grant)->orderBy('id_application')->get();
                break;
        }
        return view('pages.token.setting')->with('data', ['token' => $token, 'user' => $user, 'functions' => $functions, 'function_tokens' => $function_tokens]);
    }

    public function setFunction(Request $request)
    {
        if ($request->status == 'true') {
            $data = new FunctionToken;
            $data->id_token = $request->id_token;
            $data->id_function = $request->id_function;
            $data->save();
            echo "Data saved successfully";
        } else {
            $data = FunctionToken::where('id_token', $request->id_token)->where('id_function', $request->id_function)->get();
            for ($i=0; $i < $data->count(); $i++) { 
                $data[$i]->delete();
            }
            echo "Data deleted successfully";
        }
    }

    public function destroy($token_id)
    {
        $token = Token::find($token_id);
        $token->delete();
        $function_token = FunctionToken::where('id_token', $token_id)->get();
        for ($i=0; $i < $function_token->count(); $i++) { 
            $function_token[$i]->delete();
        }
        return redirect('/token');
    }



}
