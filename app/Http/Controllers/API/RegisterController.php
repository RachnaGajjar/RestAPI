<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Exceptions\Handler;
class RegisterController extends BaseController
{
    /*
        create API for Registration Page
    */
    public function register(Request $request)
    {
        //Validation for Register API.

         $validator = Validator::make
            ($request->all(), 
        [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:20',
            'retype_password'=>'required|same:password',
            'phone' => 'required|max:10',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        try
        {
            $user = User::create($input);

        }
        catch(\Exception $e)
        {
          return $this->sendError('Email or Phone number is already exist .');   
        }

        /*create Token */
        
        $success['token'] =  $user->createToken('api_project')->accessToken;
        $success['id']=$user->id;
        $success['email'] =  $user->email;
   
        return $this->sendResponse($success, 'User register successfully.');


    }

}
