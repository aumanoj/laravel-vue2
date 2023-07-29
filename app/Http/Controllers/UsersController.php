<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\arr;
class UsersController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        // $users = users::all();
        // return $users;

        $users = User::with('roles')->paginate(50);
        return response()->json($users);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return response()->json($roles);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => ['required'],
        //     'email' => ['required', 'email', 'unique:users'],
        //     'phone' => ['required'],
        //     'password' => ['required', 'min:8', 'confirmed']
        // ]);

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'password' => Hash::make($request->password),
        //     'super_admin'=>$request->super_admin
        // ]);

        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required'],
            'password' => ['required', 'min:8', 'confirmed','regex:/[a-z]/','regex:/[0-9]/', ],
            'roles' => ['required']
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    

    }

    public function show($id)
    {
      $user = User::where('id', $id)->first();
      return response()->json($user);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
    
        return response()->json(array('user'=>$user,'roles'=>$roles,'userRole'=>$userRole));
    }

    public  function update($id,Request $request)
    {

    //   $user = User::find($id);
    //   $user->update($request->all());
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'phone' => 'required',
        //'password' => '',
        'roles' => 'required'
    ]);

    $input = $request->all();
    if(!empty($input['password'])){ 
        $input['password'] = Hash::make($input['password']);
    
    }else{
        //$user = User::find(Auth::user()->id);
        $input = arr:: except($input,array('password'));    
    }
    $user = User::find($id);
    $user->update($input);
    DB::table('model_has_roles')->where('model_id',$id)->delete();
    $user->assignRole($request->input('roles'));

    }

    public function destroy(Request $request)
    {
       // User::find($request->id)->delete();
         $user=User::find($request->id);

        // if ($user->super_admin == 1) {
        //     return response()->json(['errors' => 'Can not delete Admin!'], 422);
        // }
        if ($user->id == Auth::user()->id) {
            return response()->json(['errors' => 'You are currently logged in!'], 401);
        }
        else{
        User::find($request->id)->delete();
        }
    }



    public function editProfile($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
    
        return response()->json(array('user'=>$user,'roles'=>$roles,'userRole'=>$userRole));
    }


    public  function profile($id,Request $request)
    {

    //   $user = User::find($id);
    //   $user->update($request->all());
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'phone' => 'required',
        //'password' => '',
        'roles' => 'required'
    ]);

    $input = $request->all();
    if(!empty($input['password'])){ 
        $input['password'] = Hash::make($input['password']);
    
    }else{
        //$user = User::find(Auth::user()->id);
        $input = arr:: except($input,array('password'));    
    }
    $user = User::find($id);
    $user->update($input);
    DB::table('model_has_roles')->where('model_id',$id)->delete();
    $user->assignRole($request->input('roles'));

    }
}
