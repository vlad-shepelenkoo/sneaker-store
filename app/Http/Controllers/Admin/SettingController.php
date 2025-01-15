<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use Illuminate\Http\Request;
use App\Models\User;

class SettingController extends Controller
{
    public function settings(Request $request){
        $user = User::find($request->user()->id);
        return view('admin.settings', compact('user'));
    }

    public function settings_update(UpdateSettingRequest $request){
        $validatedSetting = $request->validated();
        $user = User::find($request->user()->id);
        $user->update($validatedSetting);

        return redirect()->route('admin.settings')->with('status', 'User has been updated successfully');
    }
}