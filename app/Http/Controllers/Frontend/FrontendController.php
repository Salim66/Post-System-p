<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Communicate;
use App\Models\Contacts;
use App\Models\Logo;
use App\Models\Mission;
use App\Models\NewsEvent;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Vission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailContactUsConfirmationMail;

class FrontendController extends Controller
{
    //Home
    public function index(){
        $logo = Logo::first();
        $sliders = Slider::all();
        $contact = Contacts::first();
        $mission = Mission::first();
        $vission = Vission::first();
        $news_events = NewsEvent::latest()->get();
        $services = Service::all();
        return view('frontend.home', [
            'logo' => $logo,
            'sliders' => $sliders,
            'contact' => $contact,
            'mission' => $mission,
            'vission' => $vission,
            'news_events' => $news_events,
            'services' => $services,
        ]);
    }

    //About Us
    public function aboutUs(){
        $logo = Logo::first();
        $contact = Contacts::first();
        $about = About::first();
        return view('frontend.about-us', [
            'logo' => $logo,
            'contact' => $contact,
            'about' => $about,
        ]);
    }

    //Our Vission
    public function ourMission(){
        $logo = Logo::first();
        $contact = Contacts::first();
        $mission = Mission::first();
        return view('frontend.our-mission', [
            'logo' => $logo,
            'contact' => $contact,
            'mission' => $mission,
        ]);
    }

    //Our Vission
    public function ourVission(){
        $logo = Logo::first();
        $contact = Contacts::first();
        $vission = Vission::first();
        return view('frontend.our-vission', [
            'logo' => $logo,
            'contact' => $contact,
            'vission' => $vission,
        ]);
    }

    //News and Events
    public function newsAndEvents(){
        $logo = Logo::first();
        $contact = Contacts::first();
        $news_events = NewsEvent::latest()->get();
        return view('frontend.news-and-events', [
            'logo' => $logo,
            'contact' => $contact,
            'news_events' => $news_events,
        ]);
    }

    //Contact Us
    public function contactUs(){
        $logo = Logo::first();
        $contact = Contacts::first();
        return view('frontend.contact-us', [
            'logo' => $logo,
            'contact' => $contact,
        ]);
    }

    //Details News Events
    public function newsEventsDetails($id){
        $logo = Logo::first();
        $contact = Contacts::first();
        $news_details = NewsEvent::find($id);
        return view('frontend.news-event-details', [
            'logo' => $logo,
            'contact' => $contact,
            'news_details' => $news_details,
        ]);
    }

    //Users Contact
    public function communicateUser(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'address' => 'required',
            'message' => 'required',
        ]);

        Communicate::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'message' => $request->message,
        ]);

        $contact_details = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'message' => $request->message,
        ];

        Mail::to($request->email,)->send( new EmailContactUsConfirmationMail($contact_details));

        return redirect()->back()->with('success', 'Your message has been send successfully!');
    }
}
