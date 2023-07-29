<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CountryRegion;

class CountryController extends Controller
{
	public function index()
	{
		$country = CountryRegion::orderBy('country_name')
			->paginate(50);

		return view('countries.index', [
			'countries' => $country
		]);
	}

	public function create()
	{
		return view('countries.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'country_code' => 'required|max:2|unique:countries,country_code',
			'country_name' => 'required|max:100|unique:countries,country_name'
		]);

		$country = new CountryRegion;
		$country->country_code = $request->country_code;
		$country->country_name = $request->country_name;
		$country->ads_status = $request->status;
		$country->save();

		return redirect('/admin/countries')->with('success','Country added successfully');  
	}

	public function edit($id)
	{
		$country = CountryRegion::find($id);

		return view('countries.edit', [
			'countries' => $country
		]);
	}

	public function update($id, Request $request)
	{
		$request->validate([
			'country_code' => 'required|max:2|unique:countries,country_code,'.$id,
			'country_name' => 'required|max:100|unique:countries,country_name,'.$id
		]);
		
		$country = CountryRegion::find($id);
		$country->country_code = $request->country_code;
		$country->country_name = $request->country_name;
		$country->ads_status = $request->status;
		$country->save();
		
		return redirect('/admin/countries')->with('update','Country edited successfully');  
	}

	public function destroy($id)
	{
		$network = Network::where('country_id',$id)->get();
		if (count($network) > 0)
		{
			return redirect('/admin/countries')->with('error','Cannot delete as country present in Network');
		}

		CountryRegion::find($id)->delete();

		return redirect('/admin/countries')->with('update','Country deleted successfully');
	}
}
