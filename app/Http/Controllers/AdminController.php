<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Models\Admin;
use App\Mail\RegistrationConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\Admin as AdminResource;
use App\Http\Controllers\BaseController as BaseController;

class AdminController extends BaseController
{
    public function login(Request $request){
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){;

            $authUser = Auth::guard('admin')->user();
            $success["token"] = $authUser->createToken("MyAuthApp", ['admin'])->plainTextToken;
            $success["name"] = $authUser->name;
            return $this->sendResponse($success, "Sikeres bejelentkezés.");
        }
        else
        {
          return $this->sendError("Unauthorizd.".["error" => "Hibás adatok"], 401);
        }

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "confirm_password" => "required|same:password"
        ]);

        if($validator->fails())
        {
            return $this->sendError("Error validation", $validator->errors() );
        }

        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user = Admin::create($input);
        $success ["name"] = $user->name;
        Mail::to($user->email)->send(new RegistrationConfirmation($user));

        return $this->sendResponse($success, "Sikeres regisztráció.");

    }
    public function logout(Request $request){

        auth("sanctum")->user()->currentAccessToken()->delete();

        return response()->json("Sikeres kijelentkezés");
    }
}
