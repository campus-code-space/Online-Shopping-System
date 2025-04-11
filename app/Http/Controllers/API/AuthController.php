<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;


class AuthController extends Controller
{
    public function register(Request $request){
             
                  //smtp checking here
 
             //validating the request
             
             $validator = Validator::make($request->all(),[
                "name"=>"required|string",
                "email"=>"required|email",
                "password"=>"required|string",
                'role'=>"required|string",
                'phone_number'=>"required|string", 
                // 'verified_phone_number'=>"required|boolean", 
                // 'address'=>"string",
                // 'fayda_number'=>"string",
                // 'profile_image'=>"string",
                // 'identity_card_image'=>"string", 
                // 'delivery_mode'=>"string"
             ]);

             if($validator->fails()){

                return response()->json([
                    "status"=>0,
                    "message"=>"Validation error",
                    "data"=>$validator->errors()->all()
                ]);
             }

             //Full Schema is not finished its for dev purpose
             $user = User::create([
                    "name"=>$request->name,
                    "email"=>$request->email,
                    "password"=>bcrypt($request->password),
                    'role'=>$request->role,
                    'phone_number'=>$request->phone_number, 
                    // 'verified_phone_number'=>$request->verified_phone_number, 
             ]);

             $response=[];
             $token = $user->createToken("My_App",[$user->role])->plainTextToken;
             //gives the token ability with specific role

             $response["token"] = $token;
             $response["name"] = $user->name; 
             $response["email"] = $user->email; 

   
                 return response()->json([
                     "status"=>1,
                     "message"=>"user registered successfully",
                     "data"=>$response
                    ]);
    }

    public function login(Request $request){

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            
            
            // if($user->tokenCan('admin')){
            //     return "HJhjjlkjlk";
            // }
            // dd(Auth::user()->currentAccessToken());

            
           
            $response = [];

            $response["name"]= $user->name;
            $response["email"]= $user->email;
            $response["token"]= $user->createToken('My_app')->plainTextToken;

            
            return response()->json([
                "status"=>1,
                "message"=>"user registered successfully",
                "data"=>$response
            ]);
        }

            return response()->json([
                "status"=>0,
                "message"=>"user Authentication Error",
                "data"=>null
            ]);
        
    }
}
