<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    //supplier wise category
    public function supplierWiseCategory(Request $request)
    {
        $data = Product::with('category')->select('category_id')->where('supplier_id', $request->supplier_id)->groupBy('category_id')->get();
        return response()->json($data);
    }
    //category wise product
    public function categoryWiseProduct(Request $request)
    {
        $data = Product::where('category_id', $request->category_id)->get();
        return response()->json($data);
    }
}
