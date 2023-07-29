<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TblOrderDetail;
use Auth;
use DB;
use Session;
use Mail;

class ClientController extends Controller
{
    public function login()
    {
        $user= Session::get('clients');
        if($user){

            return redirect('/dashboard/');

        }
    	return view('clients.login');
    }

    public function process_login(Request $request)
    {   //print_r($request->toArray()); exit;
       request()->validate([
        'email' => 'required|email',
        'password' => 'required',
        ]);
        $order_users = DB::table('order_users')->where('email',$request->email)->where('password',$request->password)->count();
        //echo $order_users; exit;
        //$credentials = $request->only('email', 'password');
    	
            // echo $user; exit;
        //echo Auth::attempt($credentials); exit;
        if ($order_users)
        {
            Session::put('clients', $request->email);
            $user= Session::get('clients');

    		$orderDetail = TblOrderDetail::with('Manufacturer')
    			->with('Model')
    			->with('Network')
    			->with('Tool')
    			->join('tbl_orders', 'tbl_orders.order_id', 'tbl_order_details.order_id')
    			->where('tbl_orders.email',$request->email)
    			->where('status',1)
    			->get();

    		return redirect('/dashboard/');
    	}

        return redirect('/clients/login')->with('error','Oops !! Invalid Credentials');
    }

    public function logout()
    {
    	Session::forget('clients');
    	return redirect('/');
    }


    public function forgotpwd(Request $request)
    {
        
    	return view('clients.forgotPassword');
    }

    public function forgotpassword(Request $request)
    {
        $this->validate($request, [   
            'email' => 'required|email',
    ]);

    

    // print_r($request->name);
    $order_users = DB::table('order_users')->where('email',$request->email)->get();

    //print_r($order_users[0]); exit;
if (!empty($order_users[0])){
Mail::send('clients.email', [
    'email' => $request->get('email'),
    'password'=>$order_users[0]->password ],

    function ($message)use ($request) {
        
            $message->from('info@demoninja.com');
            $message->to($request->email)
            ->subject('Forgot Password ');
});
return redirect('/clients/forgotpassword')->with('success','Password Sent on Your Mail.');
}
    	return redirect('/clients/forgotpassword')->with('error','Oops !! Invalid Email');
    }
}
