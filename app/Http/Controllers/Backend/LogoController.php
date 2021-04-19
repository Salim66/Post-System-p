<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    //view logo
    public function view(){
        $count_logo = Logo::count();
        $all_logo = Logo::all();
        return view('backend.logo.view-logo', [
            'all_logo' => $all_logo,
            'count_logo' => $count_logo,
        ]);
    }
    //add logo
    public function add(){
        return view('backend.logo.add-logo');
    }
    //Store logo
    public function store(Request $request){
        if($request->hasFile('image')){
            $image = $request->file('image');
            $uniqui_file_name = md5(time().rand()).'.'. $image->getClientOriginalExtension();
            $image->move(public_path('upload/logo_images'),$uniqui_file_name);
        }

        Logo::create([
            'image'  => $uniqui_file_name,
        ]);
        return redirect()->route('logo.view')->with('success', 'Logo Added Successfully!');
    }
    //Edit Logo
    public function edit($id){
        $logo = Logo::find($id);
        return view('backend.logo.edit-logo', [
            'logo' => $logo,
        ]);
    }
     //Update logo
     public function update(Request $request, $id){
         $logo = Logo::find($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $uniqui_file_name = md5(time().rand()).'.'. $image->getClientOriginalExtension();
            $image->move(public_path('upload/logo_images'),$uniqui_file_name);
            if(file_exists('upload/logo_images/'.$logo->image) AND !empty($logo->image)){
                unlink('upload/logo_images/'.$logo->image);
            }
        }else {
            $uniqui_file_name = $logo->image;
        }

        $logo->image = $uniqui_file_name;
        $logo->update();

        return redirect()->route('logo.view')->with('success', 'Logo Updated Successfully!');
    }
    //Logo Delete
    public function delete($id){
        $logo = Logo::find($id);
        $logo->delete();
        if(file_exists('upload/logo_images/'.$logo->image) AND !empty($logo->image)){
            unlink('upload/logo_images/'.$logo->image);
        }
        return redirect()->route('logo.view')->with('success', 'Logo Deleted Successfully!');
    }
}
