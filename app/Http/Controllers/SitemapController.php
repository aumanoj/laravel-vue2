<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;

class SitemapController extends Controller
{
	public function index()
	{
		/*$brands = Manufacturer::where('status',1)->get();
		$models = Models::with('manufacturers:id,manu_name')
			->where('status',1)
			->get();

		return response()->view('sitemap.index',[
			'brands' => $brands,
			'modals' => $modals])->header('Content-Type', 'text/xml');*/
	}

	public function brands()
	{
		/*$brand = Manufacturer::where('status',1)
			->orderBy('priority_number','desc')
			->orderBy('manu_name')
			->get();

		return response()->view('sitemap.brand',[
			'brands' => $brand])->header('Content-Type','text/xml');*/

		$brand = [];
		$brand = ['Apple','Samsung','ZTE','HTC','LG','Motorola'];
		$othBrand = Manufacturer::select('manu_name')
			->where('status',1)
			->whereNotIn('manu_name',$brand)
			->orderBy('manu_name')
			->get();
		foreach ($othBrand as $oBrnd)
		{
			$brand[] = $oBrnd->manu_name;
		}

		return response()->view('sitemap.brand',['brands' => $brand])->header('Content-Type','text/xml');
	}

	public function models()
	{
		/*$modalTop = Manufacturer::where('manufacturers.status',1)
			->where('manufacturers.priority_number','!=',0)
			->orderBy('manufacturers.priority_number','desc')
			->orderBy('manu_name')
			->join('models','models.manu_id','manufacturers.manu_id')
			->where('models.status',1)
			->where('models.priority_number','!=',0)
			->orderBy('models.priority_number','desc')
			->orderBy('model_num')
			->get();

		$modalBottom = Manufacturer::where('manufacturers.status',1)
			->orderBy('manu_name')
			->join('models','models.manu_id','manufacturers.manu_id')
			->where('models.status',1)
			->where('models.priority_number',0)
			->orderBy('model_num')
			->get();
		return response()->view('sitemap.modal',[
			'modalTops' => $modalTop,'modalBottoms' => $modalBottom])->header('Content-Type','text/xml');*/

		$brand = ['Apple','Samsung','ZTE','HTC','LG','Motorola'];
		$name_ordered = implode(',',$brand);

		$topModel = Manufacturer::select('manu_name','model_num')
			->join('models','manufacturers.manu_id','models.manu_id')
			->whereIn('manufacturers.manu_name',['Apple','Samsung','ZTE','HTC','LG','Motorola'])
			->where('models.priority_number','!=',0)
			->orderByRaw('FIELD(manufacturers.manu_name,"Apple","Samsung","ZTE","HTC","LG","Motorola")')
			->get();

		$topModel1 = Manufacturer::select('manu_name','model_num')
			->join('models','manufacturers.manu_id','models.manu_id')
			->whereIn('manufacturers.manu_name',['Apple','Samsung','ZTE','HTC','LG','Motorola'])
			->where('models.priority_number',0)
			->orderByRaw('FIELD(manufacturers.manu_name,"Apple","Samsung","ZTE","HTC","LG","Motorola")')
			->get();
		
		$topModel2 = Manufacturer::select('manu_name','model_num')
			->join('models','manufacturers.manu_id','models.manu_id')
			->whereNotIn('manufacturers.manu_name',['Apple','Samsung','ZTE','HTC','LG','Motorola'])
			->orderBy('manu_name')
			->orderBy('models.priority_number','desc')
			->orderBy('model_num')
			->get();
		
		return response()->view('sitemap.modal',[
			'topModel1' => $topModel,'topModel2' => $topModel1,'topModel3' => $topModel2])->header('Content-Type','text/xml');

/*
		Brand site map sequence

Apple
Smasung
ZTE
HTC
LG
Motorola
In the end load all pending brands

Models site map sequence

Top Models

Top Apple Models
Top Smasung Models
Top ZTE Models
Top HTC Models
Top LG Models
Top Motorola Models
In the end load all pending Top models

Normal Models

Pending Normal Apple Models
Pending Normal Smasung Models
Pending Normal ZTE Models
Pending Normal HTC Models
Pending Normal LG Models
Pending Normal Motorola Models
Pending Normal In the end load all pending Top models*/
	}
}

 