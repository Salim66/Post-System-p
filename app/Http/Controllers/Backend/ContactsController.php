<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Communicate;
use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    //view Contact
    public function view(){
        $contact_count = Contacts::count();
        $all_contact = Contacts::all();
        return view('backend.contact.view-contact', [
            'all_contact' => $all_contact,
            'contact_count' => $contact_count,
        ]);
    }
    //add Contact
    public function add(){
        return view('backend.contact.add-contact');
    }
    //Store Contact
    public function store(Request $request){

        Contacts::create([
            'address'         => $request -> address,
            'mobile'          => $request -> mobile,
            'email'            => $request -> email,
            'facebook'       => $request -> facebook,
            'twitter'           => $request -> twitter,
            'youtube'         => $request -> youtube,
            'google_plus'   => $request -> google_plus,
        ]);
        return redirect()->route('contacts.view')->with('success', 'Contact Added Successfully!');
    }
    //Edit Contact
    public function edit($id){
        $contact = Contacts::find($id);
        return view('backend.contact.edit-contact', [
            'contact' => $contact,
        ]);
    }
     //Update Contact
     public function update(Request $request, $id){
         $contact = Contacts::find($id);

         $contact->address       = $request -> address;
         $contact->mobile        = $request -> mobile;
         $contact->email           = $request -> email;
         $contact->facebook      = $request -> facebook;
         $contact->twitter          = $request -> twitter;
         $contact->youtube        = $request -> youtube;
         $contact->google_plus  = $request -> google_plus;
         $contact->update();

        return redirect()->route('contacts.view')->with('success', 'Contact Updated Successfully!');
    }
    //Serice Contact
    public function delete($id){
        $contact = Contacts::find($id);
        $contact->delete();
        return redirect()->route('contacts.view')->with('success', 'Contact Deleted Successfully!');
    }

    //User Communicate
    public function allCommunicateShow(){
        $all_communicate = Communicate::latest()->get();
        return view('backend.contact.view-communicate', [
            'all_communicate' => $all_communicate
        ]);
    }

    //Delete Communicate
    public function deleteCommunicate($id){
        $communicate_info = Communicate::find($id);
        $communicate_info->delete();
        return redirect()->route('contacts.communicate')->with('success', 'Communicate Deleted Successfully!');
    }
}
