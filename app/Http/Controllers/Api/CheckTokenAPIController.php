<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;

// Model
use App\Model\Token;
use App\Model\Functions;
use App\Model\FunctionToken;
use App\Model\Users;

use Carbon\Carbon;
use Hash;
use Response;

class CheckTokenAPIController extends Controller
{

    public function authToken(Request $request)
    {
        if (!$request->id_token || !$request->token || !$request->function_code) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "Invalid request"
            ], 404);
        }

        $data_token = Token::find($request->id_token);

        if (!$data_token) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "You dont have access"
            ], 404);    
        }

        if (($data_token->limit && $data_token->limit == $data_token->accessed_times) || $data_token->expired_at == Carbon::now()) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "Your token is expired or exceeds the limit"
            ], 404);
        }

        $token_right = Hash::check($request->token, $data_token->token);
        
        if (!$token_right) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "Invalid token"
            ], 404);
        }

        $data_function = Functions::where('code', $request->function_code)->first();

        if (!$data_function) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "Invalid function code"
            ], 404);
        }

        $data_function_token = FunctionToken::where('id_token', $data_token->id)->where('id_function', $data_function->id)->first();

        if (!$data_function_token) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "This token doesnt have access for this function"
            ], 404);
        }

        $data_token->accessed_times = $data_token->accessed_times + 1;
        $data_token->save();
            
        return Response::json([
            "success"  => true,
            "data" => [],
            "message" => "You have access"
        ]);
    }

    public function checkToken(Request $request)
    {
        if (!$request->username || !$request->secret || !$request->password || !$request->id_token) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "Invalid request"
            ], 404);
        }

        $username = $request->username;
        $secret = $request->secret;
        $user = Users::where("username", $username)->where("secret", $secret)->first();

        if (!$user) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "User not found"
            ], 404);    
        }

        $password = $request->password;
        $password_right = Hash::check($password, $user->password);

        if (!$password_right) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "Wrong password"
            ], 404);    
        }

        $data_token = Token::with('function_token')->find($request->id_token);

        if (!$data_token || ($data_token->id_user != $user->id)) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "This token not found or token id is not belong to you"
            ], 404);
        }

        return Response::json([
            "success"  => true,
            "data" => $data_token,
            "message" => "Token function retrieve successfully"
        ]);

    }

}
