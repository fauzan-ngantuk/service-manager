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

class DevRequestFunctionAPIController extends Controller
{

    public function requestFunction(Request $request)
    {
        if (!$request->username || !$request->password || !$request->secret || !$request->id_token || !$request->function_code || !$request->function_name) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "Invalid request"
            ], 404);
        }

        $username = $request->username;
        $secret = $request->secret;
        $user = Users::where("username", $username)->where("secret", $secret)->first();

        if (!$user || $user->role != "developer") {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "User not found or you are not developer"
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

        $data_token = Token::find(intval($request->id_token));
        if (!$data_token || ($data_token->id_user != $user->id)) {
            return Response::json([
                "success"  => false,
                "data" => [],
                "message" => "This token not found or token id is not belong to you"
            ]);
        }

        $data_function = Functions::where('code', $request->function_code)->first();
        if (!$data_function) {
            $data_function = new Functions;
            $data_function->id_application = intval($user->application_grant);
            $data_function->code = $request->function_code;
            $data_function->name = $request->function_name;
            $success = $data_function->save();

            if (!$success) {
                return Response::json([
                    "success"  => false,
                    "data" => [],
                    "message" => "Failed to register the function"
                ]); 
            }
        }

        $data_function_token = new FunctionToken;
        $data_function_token->id_function = $data_function->id;
        $data_function_token->id_token = $request->id_token;
        $success = $data_function_token->save();

        if (!$success) {
          $data_function->delete();
          return Response::json([
            "success"  => false,
            "data" => [],
            "message" => "Failed to register the function"
          ]); 
        }

        return Response::json([
          "success"  => true,
          "data" => [],
          "message" => "Fuction " . $request->function_code . " for " . $request->function_name . " registered"
        ]);
    }

}
