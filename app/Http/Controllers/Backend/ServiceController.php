<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //view Service
    public function view(){
        $all_service = Service::all();
        return view('backend.service.view-service', [
            'all_service' => $all_service,
        ]);
    }
    //add Service
    public function add(){
        return view('backend.service.add-service');
    }
    //Store Service
    public function store(Request $request){

        Service::create([
            'title'           => $request -> title,
            'sub_title'   => $request -> sub_title,
        ]);
        return redirect()->route('service.view')->with('success', 'Service Added Successfully!');
    }
    //Edit Service
    public function edit($id){
        $service = Service::find($id);
        return view('backend.service.edit-service', [
            'service' => $service,
        ]);
    }
     //Update Service
     public function update(Request $request, $id){
         $service = Service::find($id);

        $service->title = $request->title;
        $service->sub_title = $request->sub_title;
        $service->update();

        return redirect()->route('service.view')->with('success', 'Service Updated Successfully!');
    }
    //Serice Delete
    public function delete($id){
        $service = Service::find($id);
        $service->delete();
        return redirect()->route('service.view')->with('success', 'Service Deleted Successfully!');
    }
}
