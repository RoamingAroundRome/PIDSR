<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get()->map(function ($data) {
            $roleNames = $data->getRoleNames()->toArray();
            $data['role'] = array_shift($roleNames);
            
            return $data;
        });

        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
        ]);
        $user->setRole($request->role);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::whereId($id)->with('dru.address')->first();
        $user['role'] = $user->getFirstRole();
        
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = Arr::except($request->all(), [
            'role', 
            'password_confirmation'
        ]);
        
        $data = Arr::where($data, function ($value, $key) {
            return $value != null;
        });

        $user->update($data);
        $user->setRole($request->role);

        if ($request->get('password') != null) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return response()->json($request->all(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->id == $user->id) {
            abort(422, 'You are not allowed to delete yourself.');
        }
        
        $deleted = $user->delete();
        
        return response()->json($deleted, 200);
    }
}
