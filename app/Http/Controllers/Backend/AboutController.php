<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
     //view About us
    public function view(){
        $about_count = About::count();
        $all_about = About::all();
        return view('backend.about.view-about', [
            'all_about' => $all_about,
            'about_count' => $about_count,
        ]);
    }
    //add About us
    public function add(){
        return view('backend.about.add-about');
    }
    //Store About us
    public function store(Request $request){

        About::create([
            'description'         => $request -> description,
        ]);
        return redirect()->route('abouts.view')->with('success', 'Abouts us Added Successfully!');
    }
    //Edit About us
    public function edit($id){
        $about = About::find($id);
        return view('backend.about.edit-about', [
            'about' => $about,
        ]);
    }
     //Update About us
     public function update(Request $request, $id){
         $about = About::find($id);

         $about->description   = $request -> description;
         $about->update();

        return redirect()->route('abouts.view')->with('success', 'About us Updated Successfully!');
    }
    //Serice About us
    public function delete($id){
        $about = About::find($id);
        $about->delete();
        return redirect()->route('abouts.view')->with('success', 'About us Deleted Successfully!');
    }
}
