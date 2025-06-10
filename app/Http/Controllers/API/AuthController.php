<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyOtpMail;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use PDO;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class AuthController extends Controller
{
    public function register(Request $request){
 
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
        //fix correct validation response
        return response()->json([
            "status"=>0,
            "message"=>"Validation error",
            "data"=>$validator->errors()->all()
        ]);
        }

        //checking if user duplicate exists
        $duplicateEmail = User::where('email',$request->email)->first();
        $duplicatePhone = User::where('phone_number',$request->phone_number)->first();
        //check duplicate for faydanumber and other for future

        if($duplicateEmail!=null){
            return response()->json([
                "status"=>0,
                "message"=>"User Has Already Registered Please use another email"
            ]);
        }
        if($duplicatePhone!=null){
        return response()->json([
            "status"=>0,
            "message"=>"User Registered Please use another phone number"
        ]);
        }

        $otpCode = random_int(1000, 9999);


        $otp = Otp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otpCode,
                'expires_at' => now()->addMinutes(10) 
            ]
        );

        try {
            Mail::to($request->email)->send(new VerifyOtpMail($otpCode));
        } catch (\Exception $e) {
            return response()->json([
                "status" => 0,
                "message" => "Could not send OTP email. Please try again later.",
                "error" => $e->getMessage()
            ], 500);
        }

        return response()->json([
            "status" => 1,
            "message" => "An OTP has been sent to your email. Please use it to verify your account."
        ]);

    }


    public function verifyAndCreateUser(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|string",
            'role' => "required|string",
            'phone_number' => "required|string",
            'otp' => 'required|numeric|digits:4'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => "Validation error",
                "errors" => $validator->errors()
            ], 422);
        }

        $otpRecord = Otp::where('email', $request->email)->where('otp', $request->otp)->first();

        // Check if OTP is invalid or expired
        if (!$otpRecord) {
            return response()->json(["status" => 0, "message" => "Invalid OTP provided."], 401);
        }

        if ($otpRecord->expires_at < now()) {
            $otpRecord->delete(); 
            return response()->json(["status" => 0, "message" => "OTP has expired. Please request a new one."], 401);
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
        $response["role"] = $user->role; 


        return response()->json([
            "status"=>1,
            "message"=>"You have registered successfully",
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
            //checkout the token ability how ur gonna solve that
            $response["token"]= $user->createToken('My_app',[$user->role])->plainTextToken;
            $response["role"]= $user->role;

            
            return response()->json([
                "status"=>1,
                "message"=>"Logged in successfully",
                "data"=>$response
            ]);
        }

            return response()->json([
                "status"=>0,
                "message"=>"Incorrect password or email",   
            ]);
        
    }


    public function logout(Request $request){
        if (Auth::check()){
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Logged out successfully'
            ], 200);
        }

        return response()->json([
                'status' => 0,
                'message' => 'Unauthorized'
            ], 401);        
    }


    public function sendOtp(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }


        $otpCode = random_int(1000, 9999);


        $otp = Otp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otpCode,
                'expires_at' => now()->addMinutes(10) 
            ]
        );

        try {
            Mail::to($request->email)->send(new VerifyOtpMail($otpCode));
        } catch (\Exception $e) {
            return response()->json([
                "status" => 0,
                "message" => "Could not send OTP email. Please try again later.",
                "error" => $e->getMessage()
            ], 500);
        }

        return response()->json([
            "status" => 1,
            "message" => "An OTP has been sent to your email. Please use it to verify your account."
        ]);

    }




}
