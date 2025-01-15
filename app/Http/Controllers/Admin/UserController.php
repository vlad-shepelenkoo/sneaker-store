<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Order;
use App\Models\User;

class UserController extends Controller
{
    public function users(){
        $users = User::orderBy('created_at', 'DESC')->paginate(10);
        $orders = Order::orderBy('created_at', 'DESC')->get();
        return view('admin.users', compact('users', 'orders'));
    }

    public function user_edit($id){
        $user = User::find($id);
        return view('admin.user-edit', compact('user'));
    }

    public function user_update(UpdateUserRequest $request){
        $validatedUser = $request->validated();
        $user = User::find($request->id);
        $user->update($validatedUser);
        return redirect()->route('admin.users')->with('status', 'User has been updated successfully');
    }
}