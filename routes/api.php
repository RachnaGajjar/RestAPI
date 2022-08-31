<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\LoanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/** 
 * 
 *  Register API  
 * 
 */

Route::post('register', [RegisterController::class, 'register'])->name('register');
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) 
{
    return $request->user();
});
*/

Route::post('login', [LoginController::class, 'login']);
     
Route::middleware('auth:api')->group( function () 
{
   Route::post('/loan-create',[LoanController::class,'createLoan']);  
});