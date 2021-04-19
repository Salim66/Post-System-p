<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //category view
    public function view()
    {
        $data = Category::where('status', true)->get();
        return view('backend.category.view-category', [
            'all_data' => $data,
        ]);
    }
    //category add
    public function add()
    {
        return view('backend.category.add-category');
    }
    //category store
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Category::create([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Data added successfully ):');
    }
    //category edit
    public function edit($id)
    {
        $data = Category::find($id);
        return view('backend.category.edit-category', [
            'data' => $data,
        ]);
    }
    //category update
    public function update(Request $request, $id)
    {
        $data = Category::find($id);
        if ($data != NULL) {
            $this->validate($request, [
                'name' => 'required',
            ]);

            $data->name = $request->name;
            $data->updated_by = Auth::user()->id;
            $data->update();
            return redirect()->route('categories.view')->with('success', 'Data updated successfully ):');
        }
    }
    //category delete
    public function delete($id)
    {
        $data = Category::find($id);
        if ($data != NULL) {
            $data->delete();
            return redirect()->back()->with('success', 'Data deleted successfully ): ');
        }
    }
}
