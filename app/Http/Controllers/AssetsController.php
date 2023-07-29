<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Asset;

class AssetsController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:assets-list|assets-create|assets-edit|assets-delete', ['only' => ['index','show']]);
         $this->middleware('permission:assets-create', ['only' => ['create','store']]);
         $this->middleware('permission:assets-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:assets-delete', ['only' => ['destroy']]);
    }


    public function index()
	{
		$assets = Asset::paginate(50);

		return response()->json($assets);
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'slug' => 'required',
            'content' => 'required',
            'status' => 'required'
        ]);
    
        Asset::create([
            'slug' => $request->slug,
            'content' => $request->content,
            'status' => $request->status
            ]);
        
    }

    public function edit($id)
	{
		$asset= Asset::where('id',$id)
				->first();
		return response()->json($asset);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'slug' => 'required',
            'content' => 'required',
            'status' => 'required'
        ]);
    
        $asset = Asset::find($id);
        $asset->slug = $request->slug;
        $asset->content = $request->content;
        $asset->status = $request->status;
        $asset->save();



        
    }

    public function destroy($id)
    {
        Asset::where('id',$id)->delete();
        
    }
}
