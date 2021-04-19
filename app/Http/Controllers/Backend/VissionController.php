<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vission;
use Illuminate\Http\Request;

class VissionController extends Controller
{
    //view Vission
    public function view(){
        $vission_count = Vission::count();
        $all_vission = Vission::all();
        return view('backend.vission.view-vission', [
            'all_vission' => $all_vission,
            'vission_count' => $vission_count,
        ]);
    }
    //add Vission
    public function add(){
        return view('backend.vission.add-vission');
    }
    //Store Vission
    public function store(Request $request){
        if($request->hasFile('image')){
            $image = $request->file('image');
            $uniqui_file_name = md5(time().rand()).'.'. $image->getClientOriginalExtension();
            $image->move(public_path('upload/vission_images'),$uniqui_file_name);
        }

        Vission::create([
            'title'           => $request -> title,
            'image'       => $uniqui_file_name,
        ]);
        return redirect()->route('vission.view')->with('success', 'Vission Added Successfully!');
    }
    //Edit Vission
    public function edit($id){
        $vission = Vission::find($id);
        return view('backend.vission.edit-vission', [
            'vission' => $vission,
        ]);
    }
     //Update Vission
     public function update(Request $request, $id){
         $vission = Vission::find($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $uniqui_file_name = md5(time().rand()).'.'. $image->getClientOriginalExtension();
            $image->move(public_path('upload/vission_images'),$uniqui_file_name);
            if(file_exists('upload/vission_images/'.$vission->image) AND !empty($vission->image)){
                unlink('upload/vission_images/'.$vission->image);
            }
        }else {
            $uniqui_file_name = $vission->image;
        }

        $vission->title = $request->title;
        $vission->image = $uniqui_file_name;
        $vission->update();

        return redirect()->route('vission.view')->with('success', 'Vission Updated Successfully!');
    }
    //Vission Delete
    public function delete($id){
        $vission = Vission::find($id);
        $vission->delete();
        if(file_exists('upload/vission_images/'.$vission->image) AND !empty($vission->image)){
            unlink('upload/vission_images/'.$vission->image);
        }
        return redirect()->route('vission.view')->with('success', 'Vission Deleted Successfully!');
    }
}
