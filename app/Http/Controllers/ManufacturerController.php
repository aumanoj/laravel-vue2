<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;
use Image;
use Illuminate\Support\Facades\File;

class ManufacturerController extends Controller
{
	public function index()
	{
		$brands = Manufacturer::orderBy('manu_name')
		->paginate(50);

		return response()->json($brands);
	}

	public function search(Request $request){

		// if (isset($request->search)){
      
			$brands=Manufacturer::orderBy('manu_name')
			->where('manu_name','like', '%'.$request->search.'%')
			->paginate(20);
			return response()->json($brands);
		//}

	}

	public function create()
	{
		return view('manufacturers.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'manu_id' => 'required|unique:manufacturers',
			'manu_name' => 'required|max:250',
			// 'manu_image' => 'required|image|mimes:png|max:2048',
			// 'alt_img_text' => 'required|max:250',
			'description' => 'required',
			// 'desc_rule' => 'required',
			'meta_title' => 'required',
			'meta_keyword' => 'required',
			// 'meta_desc' => 'required',
			// 'priority_number' => 'required',
		],[],[
			'manu_id' => 'Manufacturer ID',
			'manu_name' => 'Manufacturer Name',
			// 'manu_image' => 'Manufacturer Image',
			// 'alt_img_text' => 'Alternate Image Text',
			'description' => 'Description',
			// 'desc_rule' => 'Description Rule',
			'meta_title' => 'META Title',
			'meta_keyword' => 'META Keyword',
			'meta_desc' => 'META Description',
			// 'priority_number' => 'Priority Number',
		]);

		if ($request->hasfile('manu_image'))
        {
        	$image = $request->file('manu_image');
        	$fName = time().'.'.$image->getClientOriginalExtension();
        	$dPath = public_path('/images/manufacturers');
            if(!(File::isDirectory($dPath)))
            {
                mkdir($dPath,0755,true);
            }
            Image::make($image)->save(public_path('/images/manufacturers/'.$fName));
        }
        
		$manu = new Manufacturer;
		$manu->manu_id = $request->manu_id;
		$manu->manu_name= $request->manu_name;
		if ($request->hasFile('manu_image'))
        {
        	$manu->manu_image = $fName;	
        }
        if (isset($request->alt_img_text) && !empty($request->alt_img_text))
        {
        	$manu->alt_img_text = $request->alt_img_text;
        }
        else
        {
        	$manu->alt_img_text = '';
        }
        if (isset($request->description) && !empty($request->description))
        {
        	$manu->description = $request->description;
        }
        else
        {
        	$manu->description = '-';
        }
		$manu->description = $request->description;
		$manu->desc_rule = $request->desc_rule;
		$manu->meta_title = $request->meta_title;
		$manu->meta_keyword = $request->meta_keyword;
		$manu->meta_desc = $request->meta_desc;
		$manu->priority_number = $request->priority_number;
		$manu->status = $request->status;
		$manu->save();

		return redirect('/admin/manufacturers')->with('success','Manufacturers added successfully');  
	}

	public function edit($id)
	{
		$brand= Manufacturer::where('id',$id)
				->first();
		return response()->json($brand);
	}

	public function update($id, Request $request)
	{
		$request->validate([
			'manu_id' => 'required|unique:manufacturers,manu_id,'.$id,
			'manu_name' => 'required|max:250',
			'manu_image' => 'nullable|image|mimes:png|max:2048',
			// 'alt_img_text' => 'required|max:250',
			'description' => 'required',
			// 'desc_rule' => 'required',
			'meta_title' => 'required',
			'meta_keyword' => 'required',
			'meta_desc' => 'required',
			// 'priority_number' => 'required',
		],[],[
			'manu_id' => 'Manufacturer ID',
			'manu_name' => 'Manufacturer Name',
			// 'manu_image' => 'Manufacturer Image',
			// 'alt_img_text' => 'Alternate Image Text',
			'description' => 'Description',
			// 'desc_rule' => 'Description Rule',
			'meta_title' => 'META Title',
			'meta_keyword' => 'META Keyword',
			'meta_desc' => 'META Description',
			// 'priority_number' => 'Priority Number',
		]);

        if (isset($request->manu_image) && !empty($request->manu_image))
        {
        	if ($request->hasfile('manu_image'))
        	{
        	   $image = $request->file('manu_image');
        	   $fName = time().'.'.$image->getClientOriginalExtension();
        	   $dPath = public_path('images/manufacturers');
               if (!(File::isDirectory($dPath)))
               {
                    mkdir($dPath,0755,true);
               }
                Image::make($image)->save(public_path('/images/manufacturers/'.$fName));
        	}	
        }

		$manu = Manufacturer::find($id);
		$manu->manu_id = $request->manu_id;
		$manu->manu_name= $request->manu_name;
		if (isset($request->manu_image) && !empty($request->manu_image))
        {
        	if ($request->hasfile('manu_image'))
        	{
				if (File::exists(public_path('/images/manufacturers/'.$manu->manu_image)))
				{
					File::delete(public_path('/images/manufacturers/'.$manu->manu_image));
				}
        		$manu->manu_image = $fName;
        	}
        }
		$manu->alt_img_text = $request->alt_img_text;
		$manu->description = $request->description;
		$manu->desc_rule = $request->desc_rule;
		$manu->meta_title = $request->meta_title;
		$manu->meta_keyword = $request->meta_keyword;
		$manu->meta_desc = $request->meta_desc;
		$manu->priority_number = $request->priority_number;
		$manu->status = $request->status;
		$manu->save();

		return redirect('/admin/manufacturers')->with('update','Manufacturer edited successfully');  
	}

	public function destroy($id)
	{
		$manu = Manufacturer::find($id);
        if ($manu)
        {
        	if (File::exists(public_path('/images/manufacturers/'.$manu->manu_image)))
			{
				File::delete(public_path('/images/manufacturers/'.$manu->manu_image));
			}
        }
        $manu->delete();

		//return redirect('/admin/manufacturers')->with('update','Manufacturers deleted successfully');
	}
}
