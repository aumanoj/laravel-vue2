<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('changePassword');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    
    public function update(Request $request)
    {
    $this->validate($request, [
        'current_password' => 'required',
        'new_password' => ['required', 'min:8'],
        'new_confirm_password' => 'required|same:new_password'
    ]);

    
    $user = User::find(Auth::user()->id);
    
    if (!Hash::check($request->current_password, $user->password)) {
      return response()->json(['errors' => 'Current password does not match'], 
        422);
    }
    
  
    $user->password = Hash::make($request->new_password);
    $user->save();
    return $user;
    }
}
