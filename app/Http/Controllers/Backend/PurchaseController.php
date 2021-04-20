<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    //purchase view
    public function view()
    {
        $data = Purchase::orderBY('date', 'desc')->latest()->get();
        return view('backend.purchase.view-purchase', [
            'all_data' => $data,
        ]);
    }
    //purchase add
    public function add()
    {
        $suppliers = Supplier::where('status', true)->get();
        $categories = Category::where('status', true)->get();
        $products = Product::where('status', true)->get();
        return view('backend.purchase.add-purchase', [
            'suppliers'  => $suppliers,
            'categories' => $categories,
            'products'   => $products,
        ]);
    }
    //purchase store
    public function store(Request $request)
    {
        if ($request->category_id != NULL) {
            $category_count = count($request->category_id);
            for ($i = 0; $i < $category_count; $i++) {
                $data = new Purchase();
                $data->supplier_id = $request->supplier_id[$i];
                $data->category_id = $request->category_id[$i];
                $data->product_id = $request->product_id[$i];
                $data->purchase_no = $request->purchase_no[$i];
                $data->date = date('Y-m-d', strtotime($request->date[$i]));
                $data->description = $request->description[$i];
                $data->buying_qty = $request->buying_qty[$i];
                $data->unit_price = $request->unit_price[$i];
                $data->buying_price = $request->buying_price[$i];
                $data->created_by = Auth::user()->id;
                $data->save();
            }
            return redirect()->route('purchases.view')->with('success', 'Data added successfully ):');
        } else {
            return redirect()->back()->with('error', 'Sorry! you do not select any item.');
        }
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
