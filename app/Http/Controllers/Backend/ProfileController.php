<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Cloner\Data;

class ProfileController extends Controller
{
    //User Profile View
    public function view(){
        return view('backend.users.view-profile');
    }
    //User Profile Edit
    public function edit(){
        return view('backend.users.edit-profile');
    }
    //User Profile Update
    public function update(Request $request){
        $user_id = Auth::user()-> id;
        $user = User::find($user_id);

        if($request -> hasFile('image')){
            $image = $request->file('image');
            $unique_file = md5(time().rand()) .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('upload/user_images/'), $unique_file);
            if(file_exists('upload/user_images/'.$user->image) AND !empty($user->image)){
                unlink('upload/user_images/'.$user->image);
            }
        }else {
            $unique_file = $user->image;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->image = $unique_file;
        $user->update();
        return redirect()->route('profile.view')->with('success', 'Profile Updated Successfully!');
    }
    //User Password Change
    public function changePassword(){
        return view('backend.users.change-password');
    }
    //User Password Update
    public function changePasswordUpdate(Request $request){
        if(Auth::attempt(['id' => Auth::user()->id, 'password' => $request->current_password])){
            $user = User::find(Auth::user()->id);
            $user->password = password_hash( $request->new_password, PASSWORD_DEFAULT);
            $user->update();
            return redirect() -> route('profile.view') -> with('success', 'Password change successfully!');
        }else{
            return redirect() -> back() -> with('error', 'Sorry! your current password do not match!');
        }
    }
}
