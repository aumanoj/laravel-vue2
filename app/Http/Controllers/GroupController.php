<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;

class GroupController extends Controller
{
	public function index()
	{
		$group = Group::orderBy('name')->paginate(50);

		return view('groups.index', [
			'groups' => $group
		]);
	}

	public function create()
	{
		return view('groups.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|max:100'
		]);

		$group = new Group;
		$group->name = $request->name;
		$group->status = $request->status;
		$group->created_by = auth()->user()->id;
		$group->modified_by = auth()->user()->id;
		$group->save();

		return redirect('/admin/groups')->with('success','Group added successfully');  
	}

	public function edit($id)
	{
		$group = Group::find($id);

		return view('groups.edit', [
			'groups' => $group
		]);
	}

	public function update($id, Request $request)
	{
		$request->validate([
			'name' => 'required|max:100'
		]);

		$group = Group::find($id);
		$group->name = $request->name;
		$group->status = $request->status;
		$group->created_by = auth()->user()->id;
		$group->save();

		return redirect('/admin/groups')->with('update','Group edited successfully');  
	}

	public function destroy($id)
	{
		$user = User::where('group_id', $id)
			->where('status',1)
			->get();
		if (count($user) > 0)
		{
			return redirect('/admin/groups')->with('error','Cannot Delete as Group present in Users !');
		}
		Group::find($id)->delete();

		return redirect('/admin/groups')->with('update','Group deleted successfully');
	}
}
