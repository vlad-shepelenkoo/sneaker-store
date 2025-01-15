<?php

namespace App\Http\Controllers\User;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\AddressRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function addresses(){
        $addresses = Address::where('user_id', Auth::user()->id)->get();
        return view('user.account-address', compact('addresses'));
    }

    public function address_add(){
        return view('user.address-add');
    }

    public function address_store(AddressRequest $request){
        $validatedAddress = $request->validated();
        array_key_exists('isDefault', $validatedAddress) ? $validatedAddress['isDefault'] : $validatedAddress['isDefault'] = Constants::NOT_DEFAULT_ADDRESS;
        Address::create($validatedAddress);
        return redirect()->route('user.addresses')->with('status', 'Address has been added successfully');
    }

    public function address_edit($id){
        $address = Address::find($id);
        return view('user.address-edit', compact('address'));
    }

    public function address_update(AddressRequest $request){
        $validatedAddress = $request->validated();
        array_key_exists('isDefault', $validatedAddress) ? $validatedAddress['isDefault'] : $validatedAddress['isDefault'] = Constants::NOT_DEFAULT_ADDRESS;
        $address = Address::find($request->id);
        $address->update($validatedAddress);
        return redirect()->route('user.addresses')->with('status', 'Address has been updated successfully');
    }
}