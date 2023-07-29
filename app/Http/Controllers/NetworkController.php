<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Network;
use App\Models\CountryRegion;

class NetworkController extends Controller
{
	public function index()
	{
		$network = Network::orderBy('country_name')
			->orderBy('fun_network_name')
			->paginate(50);

		return view('networks.index', [
			'networks' => $network
		]);
	}

	public function create()
	{
		$network = CountryRegion::orderBy('country_name')->get();

		return view('networks.create', [
			'networks' => $network]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'country_id' => 'required|exists:countries,country_id',
			'fun_network_id' => 'required|unique:fun_networks,fun_network_id',
			'fun_network_name' => 'required|max:250',
			'priority_number' => 'required',
			'country_priority_number' => 'required'
		]);

		$country = CountryRegion::where('country_id', $request->country_id)->first();

		$network = new Network;
		$network->country_id = $request->country_id;
		$network->country_name = $country->country_name;
		$network->fun_network_id = $request->fun_network_id;
		$network->fun_network_name = $request->fun_network_name;
		$network->priority_number = $request->priority_number;
		$network->country_priority_number = $request->country_priority_number;
		$network->status = $request->status;
		$network->save();

		return redirect('/admin/networks')->with('success','Network added successfully');  
	}

	public function edit($id)
	{
		$country = CountryRegion::orderBy('country_name')->get();
		$network = Network::fin($id);

		return view('networks.edit', [
			'countries' => $country,
			'networks' => $network
		]);
	}

	public function update($id, Request $request)
	{
		$request->validate([
			'country_id' => 'required|exists:countries,country_id',
			'fun_network_id' => 'required|unique:fun_networks,fun_network_id,'.$id,
			'fun_network_name' => 'required|max:250',
			'priority_number' => 'required',
			'country_priority_number' => 'required'
		]);
		
		$country = CountryRegion::where('country_id',$request->country_id)->first();

		$network = Network::find($id);
		$network->country_id = $request->country_id;
		$network->country_name = $request->country_name;
		$network->fun_network_id = $request->fun_network_id;
		$network->fun_network_name = $request->fun_network_name;
		$network->priority_number = $request->priority_number;
		$network->country_priority_number = $request->country_priority_number;
		$network->status = $request->status;
		$network->save();

		return redirect('/admin/networks')->with('update','Network edited successfully');  
	}

}
