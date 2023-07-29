<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models;
use App\Models\User;
use App\Models\Manufacturer;
use Image;
use Illuminate\Support\Facades\File;

class ModelController extends Controller
{
	function __construct()
    {
         $this->middleware('permission:model-list|model-create|model-edit|model-delete', ['only' => ['index','show']]);
         $this->middleware('permission:model-create', ['only' => ['create','store']]);
         $this->middleware('permission:model-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:model-delete', ['only' => ['destroy']]);
    }

	public function index(Request $request)
	{
		$models = Manufacturer::leftjoin('models', 'models.manu_id', '=', 'manufacturers.manu_id')
			 ->orderBy('manu_name')
			 ->orderBy('model_num');
		if (isset($request->search) && !empty($request->search))
		{
			$models = $models->where('model_num','like','%'.$request->search.'%')
			->paginate(500);
		}
		else
		{
			$models = $models->paginate(50);
		}
		return response()->json($models);
	}

	public function search(Request $request)
	{
		$models = Manufacturer:://with('model:model_id,model_num')
		leftjoin('models', 'models.manu_id', '=', 'manufacturers.manu_id')
			->where('manu_name','like', '%'.$request->search.'%')
			 ->orderBy('manu_name')
			 ->paginate(500);
			//->get();

			return response()->json($models);
	}

	public function getBrands()
	{
		$brands = Manufacturer::orderBy('manu_name')->get();
		//->paginate(25);
		return response()->json($brands);
	}

	public function create()
	{
		$manu = Manufacturer::OrderBy('manu_name')
			->where('status',1)
			->get();
		return view('models.create', [
			'manufacturers' => $manu
		]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'manu_id' => 'required|exists:manufacturers,manu_id',
			'model_id' => 'required|unique:models',
			'model_name' => 'required|max:250',
			'status' => 'required',
			'priority_number' => 'required',
		],[],[
			'manu_id' => 'Manufacturer Name',
			'model_id' => 'Model ID',
			'model_name' => 'Model Number',
			'priority_number' => 'Priority Number',
			'status' => 'Status'
		]);

		$model = new Models;
		$model->manu_id = $request->manu_id;
		$model->model_id = $request->model_id;
		$model->model_num = $request->model_name;
		$model->priority_number = $request->priority_number;
		$model->status = $request->status;
		$model->save();

		return response()->json($model);  
	}

	public function edit($id)
	{
		$model = Models::with('manufacturers')
			->where('id',$id)
			->first();

			return response()->json($model);
	}

	public function update($id, Request $request)
	{
		$request->validate([
			'manu_id' => 'required|exists:manufacturers,manu_id',
			'model_id' => 'required',
			'model_name' => 'required|max:250',
			'priority_number' => 'required',
			'status' => 'required'
		],[],[
			'manu_id' => 'Manufacturer Name',
			'model_id' => 'Model ID',
			'model_name' => 'Model Number',
			'priority_number' => 'Priority Number',
			'status' => 'Status'
		]);

		
        $fModel = Models::find($id);
        $fModel->manu_id = $request->manu_id;
		$fModel->model_id = $request->model_id;
		$fModel->model_num = $request->model_name; 
		$fModel->priority_number = $request->priority_number;
		$fModel->status = $request->status;
		$fModel->save();

		//return redirect('/admin/models')->with('update','Models edited successfully');  
	}

	public function destroy($id)
	{
		$fModel = Models::find($id);
        $manu = Manufacturer::where('manu_id',$fModel->manu_id)->first();

        if ($fModel)
        {
        	if (File::exists(public_path('/images/models/'.$manu->manu_image.'/'.$fModel->model_image)))
			{
				File::delete(public_path('/images/models/'.$manu->manu_name.'/'.$fModel->model_image));
			}
        }
        $fModel->delete();

		return redirect('/admin/models')->with('update','Models deleted successfully');
	}
}
