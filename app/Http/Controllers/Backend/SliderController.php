<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //view slider
    public function view(){
        $all_slider = Slider::all();
        return view('backend.slider.view-slider', [
            'all_slider' => $all_slider,
        ]);
    }
    //add Slider
    public function add(){
        return view('backend.slider.add-slider');
    }
    //Store Slider
    public function store(Request $request){
        if($request->hasFile('image')){
            $image = $request->file('image');
            $uniqui_file_name = md5(time().rand()).'.'. $image->getClientOriginalExtension();
            $image->move(public_path('upload/slider_images'),$uniqui_file_name);
        }

        Slider::create([
            'title'           => $request -> title,
            'sub_title'   => $request -> sub_title,
            'image'       => $uniqui_file_name,
        ]);
        return redirect()->route('slider.view')->with('success', 'Slider Added Successfully!');
    }
    //Edit Slider
    public function edit($id){
        $slider = Slider::find($id);
        return view('backend.slider.edit-slider', [
            'slider' => $slider,
        ]);
    }
     //Update Slider
     public function update(Request $request, $id){
         $slider = Slider::find($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $uniqui_file_name = md5(time().rand()).'.'. $image->getClientOriginalExtension();
            $image->move(public_path('upload/slider_images'),$uniqui_file_name);
            if(file_exists('upload/slider_images/'.$slider->image) AND !empty($slider->image)){
                unlink('upload/slider_images/'.$slider->image);
            }
        }else {
            $uniqui_file_name = $slider->image;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $uniqui_file_name;
        $slider->update();

        return redirect()->route('slider.view')->with('success', 'Slider Updated Successfully!');
    }
    //Slider Delete
    public function delete($id){
        $slider = Slider::find($id);
        $slider->delete();
        if(file_exists('upload/slider_images/'.$slider->image) AND !empty($slider->image)){
            unlink('upload/slider_images/'.$slider->image);
        }
        return redirect()->route('slider.view')->with('success', 'Slider Deleted Successfully!');
    }
}
