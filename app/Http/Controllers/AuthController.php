<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(LoginRequest $request)
    {
        $credentials= $request->validated();
        if(!Auth::attempt($credentials)){
           return response(
            [
                'message'=> 'Provided password or email is incorrect.'
            ]
           );
        }
        /**  @var User $user */
       $user = Auth::user();
       $token = $user->createToken('main')->plainTextToken;
        return response(compact('user','token'));
       
    }
    public function logout(Request $request){
         /**  @var User $user */
        $user = $request->user();
        $user->currentAccessToken()->delete;
        return response('',204);

    }
}
