<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class LoanController extends BaseController
{
    public function createLoan(Request $request)
    {
        $validator = Validator::make
        ($request->all(), 
    [
        'start_date' => 'required',
        'term' => 'required',
        'amount'=>'required',
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
    $input = $request->all();
    $auth=Auth::user();
    $user_id=$auth->id;
    $input['user_id'] = $user_id;
    $user = Loan::create($input);
    try
    {
            

        }
        catch(\Exception $e)
        {
          return $this->sendError('Email or Phone number is already exist .');   
        }
    }
}
