<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function fetchAll()
    {
        return User::all();
    }

    public function fetch(User $user)
    {
        return $user;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'group_id' => 'integer',
            'state' => [Rule::in([User::STATE_ACTIVE, User::STATE_NON_ACTIVE])]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create($request->all());

        if (!$user) {
            return response()->json(['message' => 'creation failed'], 501);
        }

        $user = User::find($user->id); // get full record

        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|max:255',
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'group_id' => 'integer',
            'state' => [Rule::in([User::STATE_ACTIVE, User::STATE_NON_ACTIVE])]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user->update($request->all());

        return response()->json($user, 200);
    }
}
