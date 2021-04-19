<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    //supplier view
    public function view()
    {
        $data = Supplier::where('status', true)->get();
        return view('backend.supplier.view-supplier', [
            'all_data' => $data,
        ]);
    }
    //supplier add
    public function add()
    {
        return view('backend.supplier.add-supplier');
    }
    //supplier store
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        Supplier::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Data added successfully ):');
    }
    //supplier edit
    public function edit($id)
    {
        $data = Supplier::find($id);
        return view('backend.supplier.edit-supplier', [
            'data' => $data,
        ]);
    }
    //supplier update
    public function update(Request $request, $id)
    {
        $data = Supplier::find($id);
        if ($data != NULL) {
            $this->validate($request, [
                'name' => 'required',
                'mobile' => 'required',
                'address' => 'required',
            ]);

            $data->name = $request->name;
            $data->mobile = $request->mobile;
            $data->email = $request->email;
            $data->address = $request->address;
            $data->updated_by = Auth::user()->id;
            $data->update();
            return redirect()->route('suppliers.view')->with('success', 'Data updated successfully ):');
        }
    }
    //supplier delete
    public function delete($id)
    {
        $data = Supplier::find($id);
        if ($data != NULL) {
            $data->delete();
            return redirect()->back()->with('success', 'Data deleted successfully ): ');
        }
    }
}
