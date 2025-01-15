<?php

namespace App\Http\Controllers\User;

use App\Constants;
use App\Helpers\CheckFileForExistsHelper;
use App\Helpers\GenerateThumbnailsImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\DetailRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function __construct(private CheckFileForExistsHelper $checkFileForExists){}

    public function details(){
        $user = User::find(Auth::user()->id);
        return view('user.account-details', compact('user'));
    }

    public function details_update(DetailRequest $request){
        !$request->password ? $validatedDetail = $request->safe()->except(['old_password', 'password', 'password_confirmation']) : $validatedDetail = $request->validated();
        $user = User::find($validatedDetail['id']);
        if(isset($validatedDetail['image']))
        {
            if($user->image != Constants::DEFAULT_IMAGE) $this->checkFileForExists->checkFile(Constants::USER_IMAGE_FOLDER, $user->image);
            $image = $validatedDetail['image'];
            $validatedDetail['image'] = GenerateThumbnailsImageHelper::generateThumbnail(Constants::USER_IMAGE_FOLDER, Constants::USER_IMAGE_SIZE, $image);
        }
        
        $user->update($validatedDetail);

        return redirect()->route('user.account.details')->with('status', 'User has been updated successfully');
    }
}