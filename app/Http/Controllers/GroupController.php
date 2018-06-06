<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use Validator;

class GroupController extends Controller
{
    public function fetchAll()
    {
        return Group::all();
    }

    public function fetch(Group $group)
    {
        return $group;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $group = Group::create($request->all());

        if (!$group) {
            return response()->json(['message' => 'creation failed'], 501);
        }

        $group = Group::find($group->id); // get full record

        return response()->json($group, 201);
    }

    public function update(Request $request, Group $group)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $group->update($request->all());

        return response()->json($group, 200);
    }
}
