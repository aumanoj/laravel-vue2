<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ModelContent;
use App\Models\Manufacturer;
use App\Models\ModelImage;
use App\Models\Models;
use Image;
Use File;

class ModelContentController extends Controller
{
	function __construct()
    {
         $this->middleware('permission:model-content-list|model-content-create|model-content-edit|model-content-delete', ['only' => ['index','show']]);
         $this->middleware('permission:model-content-create', ['only' => ['create','store']]);
         $this->middleware('permission:model-content-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:model-content-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
	{
		if (isset($request->search)){
			$models = Manufacturer::
			leftjoin('model_contents', 'model_contents.manu_id', '=', 'manufacturers.manu_id')
			->where('manu_name','like', '%'.$request->search.'%')
			 ->orderBy('manu_name')
			 ->paginate(50);
			return response()->json($models);
		}
		else{
			$models = Manufacturer::
			leftjoin('model_contents', 'model_contents.manu_id', '=', 'manufacturers.manu_id')
			 ->orderBy('manufacturers.manu_name')
			 ->paginate(50);
			return response()->json($models);
		}
    }
    

    // public function search(Request $request)
	// {
	// 	$models = Manufacturer:://with('model:model_id,model_num')
	// 	leftjoin('model_contents', 'model_contents.manu_id', '=', 'manufacturers.manu_id')
	// 		->where('manu_name','like', '%'.$request->search.'%')
	// 		 ->orderBy('manu_name')
	// 		 ->paginate(50);
	// 		//->get();

	// 		return response()->json($models);
	// }

	public function getBrands()
	{
		$brands = Manufacturer::orderBy('manu_name')->get();
		return response()->json($brands);
    }

    public function getModels()
	{
		$models = Models::orderBy('model_num')->get();
		return response()->json($models);
    }
    
    public function store(Request $request)
	{
		$request->validate([
			'manu_id' => 'required',
			'model_id' => 'required',
			'model_num' => 'required|max:250',
			//'model_image' => 'required',//|mimes:png|max:2048',
			// 'image_alt_text' => 'required|max:250',
			//'description' => 'required',
			// 'desc_rule' => 'required',
			'meta_title' => 'required',
			// 'meta_keyword' => 'required',
            // 'meta_desc' => 'required',
            // 'heading_title' => 'required'
			
		],[],[
			'manu_id' => 'Brand Name',
			'model_id' => 'Model',
			'model_num' => 'Model Name',
			//'model_image' => 'Model Image',
			// 'image_alt_text' => 'Alternate Image Text',
			//'description' => 'Description',
			// 'desc_rule' => 'Description Rule',
			'meta_title' => 'META Title',
			// 'meta_keyword' => 'META Keyword',
			// 'meta_desc' => 'META Description',
			
		]);

		$uploadFiles = $request->model_image;
		 //print_r($uploadFiles);exit;
		if (!empty($uploadFiles))
        {
			foreach ($uploadFiles as $file) {  
        	$fName = $file->getClientOriginalName();
        	// $dPath = public_path('/images/model/'.$file);
            // if(!(File::isDirectory($dPath)))
            // {
            //     mkdir($dPath,0755,true);
			// }
			
			$file->move(public_path('/images/model/'), $fName);

			//$imgName[] = $fName;
			//for image add to database
			$modelImage = new ModelImage;
			$modelImage->model_id = $request->model_id;
			$modelImage->image_name = $fName;
			$modelImage->save();

			}	
		}
		

		$fModel = new ModelContent;
		$fModel->manu_id = $request->manu_id;
		$fModel->model_id = $request->model_id;
		$fModel->model_num = $request->model_num;
		// if ($request->hasFile('model_image'))
        // {
        // 	$fModel->model_image = $fNameA;	
        // }
		// $fModel->image_alt_text = $request->image_alt_text;
		$fModel->description = $request->description??'';
		$fModel->desc_rule = $request->desc_rule??'';
		$fModel->meta_title = $request->meta_title??'';
		$fModel->meta_keyword = $request->meta_keyword ?? '';
		$fModel->meta_desc = $request->meta_desc ?? '';
		$fModel->heading_title = $request->heading_title ?? '';
		$fModel->save();

			
		//return redirect('/admin/models')->with('success','Models added successfully');  
	}

    public function edit($id)
	{
		$model = ModelContent::with('manufacturers')
			->where('id',$id)
			->first();

			$model_image = ModelImage::where('model_id',$model->model_id)
			->get();

			return response()->json(array('model'=>$model,'images'=>$model_image));
    }
    

    public function update($id, Request $request)
	{
		$request->validate([
            'manu_id' => 'required',
            'model_id' =>'required',
			'model_num' => 'required|max:250',
			//'model_image' => 'required',//|image|mimes:png|max:2048',
			// 'alt_img_text' => 'required|max:250',
			//'description' => 'required',
			// 'desc_rule' => 'required',
			'meta_title' => 'required',
			// 'meta_keyword' => 'required',
			// 'meta_desc' => 'required',
			// 'heading_title' => 'required',
		],[],[
			'manu_id' => 'Manufacturer ID',
			'manu_name' => 'Manufacturer Name',
			//'model_image' => 'Model Image',
			// 'alt_img_text' => 'Alternate Image Text',
			//'description' => 'Description',
			// 'desc_rule' => 'Description Rule',
			'meta_title' => 'META Title',
			// 'meta_keyword' => 'META Keyword',
			// 'meta_desc' => 'META Description',
			// 'heading_title' => 'Priority Number',
		]);

        $uploadFiles = $request->model_image;
		 //print_r($uploadFiles);exit;
		if (!empty($uploadFiles))
        {
			foreach ($uploadFiles as $file) {  
        	$fName = $file->getClientOriginalName();
        	// $dPath = public_path('/images/model/'.$file);
            // if(!(File::isDirectory($dPath)))
            // {
            //     mkdir($dPath,0755,true);
			// }
			
			$file->move(public_path('/images/model/'), $fName);

			//$imgName[] = $fName;
			//for image add to database
		$modelImage = new ModelImage;
		$modelImage->model_id = $request->model_id;
		$modelImage->image_name = $fName;
		$modelImage->save();

			}	
		}

		//for image add to database
		// $modelImage = new ModelImage;
		// $modelImage->model_id = $request->model_id;
		// $modelImage->image_name = implode(",", $imgName);
		// $modelImage->save();

		$model = ModelContent::find($id);
        $model->manu_id = $request->manu_id;
        $model->model_id = $request->model_id;
		$model->model_num= $request->model_num;
		// $model->alt_img_text = $request->alt_img_text;
		$model->description = $request->description??'';
		$model->desc_rule = $request->desc_rule??'';
		$model->meta_title = $request->meta_title??'';
		$model->meta_keyword = $request->meta_keyword ?? '';
		$model->meta_desc = $request->meta_desc ?? '';
		$model->heading_title = $request->heading_title ??'';
		$model->save();

		//return redirect('/admin/manufacturers')->with('update','Manufacturer edited successfully');  
	}

	public function imageDelete($id){

		$modelImg= ModelImage::find($id);
        if ($modelImg)
        {
        	if (File::exists(public_path('/images/model/'.$modelImg->image_name)))
			{
				File::delete(public_path('/images/model/'.$modelImg->image_name));
			}
        }
        $modelImg->delete();
	}

}
