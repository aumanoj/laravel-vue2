<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
class CitiesController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:city-list|city-create|city-edit|city-delete', ['only' => ['index','show']]);
         $this->middleware('permission:city-create', ['only' => ['create','store']]);
         $this->middleware('permission:city-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:city-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        // $users = users::all();
        // return $users;
        $cities = City::paginate(50);
        return response()->json($cities);
    }

    public function create()
    {
        
        $name = City::get('name','name');
        return response()->json($name);
    }

    public function store(Request $request)
    {
        $request->validate([
            'city' => ['required','unique:city'],
            'state' => ['required'],
            'country' => ['required']
        ]);

        City::create([
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
        ]);


    }

    public function edit($id)
    {
      $city = City::where('id', $id)->first();
      return response()->json($city);
    }

    public  function update($id,Request $request)
    {

      $city = City::find($id);
      $city->update($request->all());
    }

    public function destroy(Request $request)
    {
        City::find($request->id)->delete();
    }
}
