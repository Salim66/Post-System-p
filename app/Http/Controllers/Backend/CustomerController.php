<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //customer view
    public function view()
    {
        $data = Customer::where('status', true)->get();
        return view('backend.customer.view-customer', [
            'all_data' => $data,
        ]);
    }
    //customer add
    public function add()
    {
        return view('backend.customer.add-customer');
    }
    //customer store
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        Customer::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Data added successfully ):');
    }
    //customer edit
    public function edit($id)
    {
        $data = Customer::find($id);
        return view('backend.customer.edit-customer', [
            'data' => $data,
        ]);
    }
    //customer update
    public function update(Request $request, $id)
    {
        $data = Customer::find($id);
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
            return redirect()->route('customers.view')->with('success', 'Data updated successfully ):');
        }
    }
    //customer delete
    public function delete($id)
    {
        $data = Customer::find($id);
        if ($data != NULL) {
            $data->delete();
            return redirect()->back()->with('success', 'Data deleted successfully ): ');
        }
    }
}
