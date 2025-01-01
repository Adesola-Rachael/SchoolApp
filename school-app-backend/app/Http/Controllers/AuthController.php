<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

use App\Interfaces\statusCode;
use App\Models\StaffApplication;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
   use  ResponseTrait;
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }
     /**
     * Create a new User 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        $validateUser = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ]);
        if($validateUser->fails()){
            return $this->apiResponse($validateUser->errors(),null, StatusCode::VALIDATION);
        }
        try {  
            $user =  User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);
            return $this->apiResponse('User Created Successfully',$user,  StatusCode::CREATED);
       
        } catch (JWTException $e) {                
            throw new Exception($e->getMessage()); 
        }
    }
    
    /**
     * Get a JWT via given credentials.
     *@param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials=$request->validate([
            'email'=>'required',    
            'password'=>'required'
        ]);
        try {  
            if (!$token = auth()->attempt($credentials)) {  
                return $this->apiResponse('You Are Unathorized', null, StatusCode::UNAUTHORIZED);
            }            
        } catch (JWTException $e) {                
            throw new Exception($e->getMessage()); 
        }
        $data = [ 
                'auth_user' => auth()->user(),
                'access_token' => $token,            
                'token_type' => 'bearer',  
                'expires_in' => config('jwt.ttl')        
            ];
            return $this->apiResponse('User logged In Successfully', $data, StatusCode::OK);
    }
    public function logout()
    {
        auth()->logout();
        return $this->apiResponse('Successfully logged out', null, StatusCode::OK);
    }

    public function create(Request $request)
    {
        $create_staff = StaffApplication::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role
        ]);
        if($create_staff){
            return response('Application submitted Successfully', 201, $create_staff);
        }
    }


}
