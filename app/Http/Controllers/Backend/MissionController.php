<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    //view Mission
    public function view(){
        $mission_count = Mission::count();
        $all_mission = Mission::all();
        return view('backend.mission.view-mission', [
            'all_mission' => $all_mission,
            'mission_count' => $mission_count,
        ]);
    }
    //add Mission
    public function add(){
        return view('backend.mission.add-mission');
    }
    //Store Mission
    public function store(Request $request){
        if($request->hasFile('image')){
            $image = $request->file('image');
            $uniqui_file_name = md5(time().rand()).'.'. $image->getClientOriginalExtension();
            $image->move(public_path('upload/mission_images'),$uniqui_file_name);
        }

        Mission::create([
            'title'           => $request -> title,
            'image'       => $uniqui_file_name,
        ]);
        return redirect()->route('mission.view')->with('success', 'Mission Added Successfully!');
    }
    //Edit Mission
    public function edit($id){
        $mission = Mission::find($id);
        return view('backend.mission.edit-mission', [
            'mission' => $mission,
        ]);
    }
     //Update Mission
     public function update(Request $request, $id){
         $mission = Mission::find($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $uniqui_file_name = md5(time().rand()).'.'. $image->getClientOriginalExtension();
            $image->move(public_path('upload/mission_images'),$uniqui_file_name);
            if(file_exists('upload/mission_images/'.$mission->image) AND !empty($mission->image)){
                unlink('upload/mission_images/'.$mission->image);
            }
        }else {
            $uniqui_file_name = $mission->image;
        }

        $mission->title = $request->title;
        $mission->image = $uniqui_file_name;
        $mission->update();

        return redirect()->route('mission.view')->with('success', 'Mission Updated Successfully!');
    }
    //Mission Delete
    public function delete($id){
        $mission = Mission::find($id);
        $mission->delete();
        if(file_exists('upload/mission_images/'.$mission->image) AND !empty($mission->image)){
            unlink('upload/mission_images/'.$mission->image);
        }
        return redirect()->route('mission.view')->with('success', 'Mission Deleted Successfully!');
    }
}
