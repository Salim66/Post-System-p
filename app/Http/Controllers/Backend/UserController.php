<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use PDO;

class UserController extends Controller
{
    //All Users
    public function view(){
        $all_users = User::latest() -> get();
        return view('backend.users.view-users', [
            'all_users' => $all_users
        ]);
    }

    //User Crate Page
    public function add(){
        return view('backend.users.add-users');
    }

    //User Store
    public function store(Request $request){
        $this->validate($request, [
            'userType'  => 'required',
            'email'     => 'required | unique:users,email',
        ]);

        User::create([
            'userType'  => $request -> userType,
            'name'      => $request -> name,
            'email'     => $request -> email,
            'password'  => password_hash($request -> password, PASSWORD_DEFAULT),
        ]);
        return redirect()->route('users.view')->with('success', 'User Added Successfully!');
    }

    //Edit User
    public function edit($id){
        $user = User::find($id);
        return view('backend.users.edit-users', [
            'user' => $user
        ]);
    }

    //Update User
    public function update(Request $request, $id){
        $user_data = User::find($id);
        $user_data -> userType = $request -> userType;
        $user_data -> name = $request -> name;
        $user_data -> email = $request -> email;
        $user_data -> update();
        return redirect()->route('users.view')->with('success', 'User Updated Successfully!');
    }

    //Delete User
    public function delete($id){
        $user_data = User::find($id);
        $user_data -> delete();
        if(file_exists('upload/user_images/'.$user_data->image) AND !empty($user_data->image)){
            unlink('upload/user_images/'.$user_data->image);
        }
        return redirect()->route('users.view')->with('success', 'User Deleted Successfully!');
    }
}
