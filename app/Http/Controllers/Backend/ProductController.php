<?php

namespace App\Http\Controllers\Backend;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //product view
    public function view()
    {
        $data = Product::where('status', true)->latest()->get();
        return view('backend.product.view-product', [
            'all_data' => $data,
        ]);
    }
    //product add
    public function add()
    {
        $suppliers = Supplier::where('status', true)->get();
        $units = Unit::where('status', true)->get();
        $categories = Category::where('status', true)->get();
        return view('backend.product.add-product', [
            'suppliers'  => $suppliers,
            'units'      => $units,
            'categories' => $categories
        ]);
    }
    //product store
    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
            'name' => 'required',
        ]);

        Product::create([
            'supplier_id' => $request->supplier_id,
            'unit_id'     => $request->unit_id,
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'created_by'  => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Data added successfully ):');
    }
    //product edit
    public function edit($id)
    {
        $data       = Product::find($id);
        $suppliers  = Supplier::all();
        $units      = Unit::all();
        $categories = Category::all();
        return view('backend.product.edit-product', [
            'data'       => $data,
            'suppliers'  => $suppliers,
            'units'      => $units,
            'categories' => $categories,
        ]);
    }
    //product update
    public function update(Request $request, $id)
    {
        $data = Product::find($id);
        if ($data != NULL) {
            $this->validate($request, [
                'supplier_id' => 'required',
                'unit_id' => 'required',
                'category_id' => 'required',
                'name' => 'required',
            ]);

            $data->supplier_id = $request->supplier_id;
            $data->unit_id = $request->unit_id;
            $data->category_id = $request->category_id;
            $data->name = $request->name;
            $data->updated_by = Auth::user()->id;
            $data->update();
            return redirect()->route('products.view')->with('success', 'Data updated successfully ):');
        }
    }
    //product delete
    public function delete($id)
    {
        $data = Product::find($id);
        if ($data != NULL) {
            $data->delete();
            return redirect()->back()->with('success', 'Data deleted successfully ): ');
        }
    }
}
