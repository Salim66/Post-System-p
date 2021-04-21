<?php

namespace App\Http\Controllers\Backend;

use PDF;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    //stock report
    public function stockReport()
    {
        $data = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        return view('backend.stock.stock-report', [
            'all_data' => $data,
        ]);
    }
    //stock report pdf
    public function stockReportPdf()
    {
        $data = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
        $pdf = PDF::loadView('backend.pdf.stock-report-pdf', [
            'all_data' => $data,
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    //supplier/product wise report
    public function supplierProductWiseReport()
    {
        $suppliers = Supplier::all();
        $categories  = Category::all();
        return view('backend.stock.supplier-product-wise-report', [
            'suppliers' => $suppliers,
            'categories'  => $categories,
        ]);
    }
    //supplier wise report pdf
    public function supplierWiseStockReportPdf(Request $request)
    {
        $data = Product::orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->where('supplier_id', $request->supplier_id)->get();
        $pdf  = PDF::loadView('backend.pdf.supplier-wise-stock-report-pdf', [
            'all_data' => $data,
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    //product wise report pdf
    public function productWiseStockReportPdf(Request $request)
    {
        $data = Product::where('category_id', $request->category_id)->where('id', $request->product_id)->first();
        $pdf  = PDF::loadView('backend.pdf.product-wise-stock-report-pdf', [
            'data' => $data,
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
