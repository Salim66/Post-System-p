<?php

namespace App\Http\Controllers\Backend;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    //unit view
    public function view()
    {
        $data = Unit::where('status', true)->get();
        return view('backend.unit.view-unit', [
            'all_data' => $data,
        ]);
    }
    //unit add
    public function add()
    {
        return view('backend.unit.add-unit');
    }
    //unit store
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Unit::create([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Data added successfully ):');
    }
    //unit edit
    public function edit($id)
    {
        $data = Unit::find($id);
        return view('backend.unit.edit-unit', [
            'data' => $data,
        ]);
    }
    //unit update
    public function update(Request $request, $id)
    {
        $data = Unit::find($id);
        if ($data != NULL) {
            $this->validate($request, [
                'name' => 'required',
            ]);

            $data->name = $request->name;
            $data->updated_by = Auth::user()->id;
            $data->update();
            return redirect()->route('units.view')->with('success', 'Data updated successfully ):');
        }
    }
    //unit delete
    public function delete($id)
    {
        $data = Unit::find($id);
        if ($data != NULL) {
            $data->delete();
            return redirect()->back()->with('success', 'Data deleted successfully ): ');
        }
    }
}
