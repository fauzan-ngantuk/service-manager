<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;

// Model
use App\Model\Functions;
use App\Model\FunctionToken;
use App\Model\Token;
use App\Model\Users;

use Carbon\Carbon;
use Hash;
use Response;

class RequestTokenAPIController extends Controller
{
    public function requestToken(Request $request)
    {
        if (!$request->username || !$request->secret || !$request->password) {
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
            ]);    
        }

        $payload = [
            "username" => $user->username,
            "role" => $user->role
        ];

        $user_token = Crypt::encrypt($payload);
        $secret_token = Crypt::encryptString($request->secret);
        $token = $user_token . "-" . $secret_token;

        $encrypted_token = bcrypt($token);
        
        $data_token = new Token;
        $data_token->id_user = $user->id;
        $data_token->token = $encrypted_token;

        if ($user->role == "guest") {
            $data_token->expired_at = Carbon::now()->addDay(10);
            $data_token->limit = 100;
            $data_token->accessed_times = 0;
        }

        $success = $data_token->save();

        if (!$success) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "Token failed to generate"
            ], 500);
        }

        if ($user->role == "guest") {
            $success = $this->_save_guest_function_token($data_token->id, $user->application_grant);
            if (!$success) {
                return Response::json([
                    "success"  => false,
                    "data" => [],
                    "message" => "Sorry, maybe the function you've been request was deleted by admin"
                ], 500);
            }
        }

        return Response::json([
            "success"  => true,
            "data" => ["id" => $data_token->id, "token" => $token],
            "message" => "Token generate successfully"
        ]);
    }

    public function _save_guest_function_token($id_token, $function_code)
    {
        $data_function = Functions::where('code', $function_code)->first();
        if (!$data_function) {
            Token::find($id_token)->delete();
            return false;
        }
        $function_token = new FunctionToken;
        $function_token->id_token = $id_token;
        $function_token->id_function = $data_function->id;
        $success = $function_token->save();
        if (!$success) {
            Token::find($id_token)->delete();
        }
        return $success;
    }
}


