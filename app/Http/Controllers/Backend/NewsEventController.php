<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\NewsEvent;
use Illuminate\Http\Request;

class NewsEventController extends Controller
{
    //view News and Event
    public function view(){
        $all_news = NewsEvent::all();
        return view('backend.news.view-news', [
            'all_news' => $all_news,
        ]);
    }
    //add News and Event
    public function add(){
        return view('backend.news.add-news');
    }
    //Store News and Event
    public function store(Request $request){
        if($request->hasFile('image')){
            $image = $request->file('image');
            $uniqui_file_name = md5(time().rand()).'.'. $image->getClientOriginalExtension();
            $image->move(public_path('upload/news_images'),$uniqui_file_name);
        }

        NewsEvent::create([
            'date'           => date('Y-m-d', strtotime( $request -> date)),
            'title'           => $request -> title,
            'sub_title'   => $request -> sub_title,
            'image'       => $uniqui_file_name,
        ]);
        return redirect()->route('news_event.view')->with('success', 'News adn Evend Added Successfully!');
    }
    //Edit News and Event
    public function edit($id){
        $news = NewsEvent::find($id);
        return view('backend.news.edit-news', [
            'news' => $news,
        ]);
    }
     //Update News and Event
     public function update(Request $request, $id){
         $news = NewsEvent::find($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $uniqui_file_name = md5(time().rand()).'.'. $image->getClientOriginalExtension();
            $image->move(public_path('upload/news_images'),$uniqui_file_name);
            if(file_exists('upload/news_images/'.$news->image) AND !empty($news->image)){
                unlink('upload/news_images/'.$news->image);
            }
        }else {
            $uniqui_file_name = $news->image;
        }

        $news->date = date('Y-m-d', strtotime($request->date));
        $news->title = $request->title;
        $news->sub_title = $request->sub_title;
        $news->image = $uniqui_file_name;
        $news->update();

        return redirect()->route('news_event.view')->with('success', 'News and Event Updated Successfully!');
    }
    //News and Event Delete
    public function delete($id){
        $news = NewsEvent::find($id);
        $news->delete();
        if(file_exists('upload/news_images/'.$news->image) AND !empty($news->image)){
            unlink('upload/news_images/'.$news->image);
        }
        return redirect()->route('news_event.view')->with('success', 'News and Event Deleted Successfully!');
    }
}
