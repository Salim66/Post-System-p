<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;

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
    //purchase delete
    public function delete($id)
    {
        $data = Purchase::find($id);
        if ($data != NULL) {
            $data->delete();
            return redirect()->route('purchases.view')->with('success', 'Data deleted successfully ): ');
        }
    }
    //purchase pending list
    public function purchasePendingList()
    {
        $data = Purchase::where('status', false)->latest()->get();
        return view('backend.purchase.purchase-pending-list', [
            'all_data' => $data,
        ]);
    }
    //purchase approved
    public function purchaseApproved($id)
    {
        $data = Purchase::find($id);
        $product = Product::where('id', $data->product_id)->first();
        if ($data != NULL) {
            $data->status = true;
            if ($data->update()) {
                $product_quantity = ((float)($data->buying_qty)) + ((float)($product->quantity));
                $product->quantity = $product_quantity;
                $product->update();
            }
            return redirect()->route('purchases.pending.list')->with('success', 'Data approved successfully ):');
        } else {
            return redirect()->back()->with('error', "Sorry! something won't wrong");
        }
    }
    //purchase daily report
    public function purchaseDailyReport()
    {
        return view('backend.purchase.purchase-daily-report');
    }
    //purchase daily report pdf
    public function purchaseDailyReportPdf(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $data = Purchase::whereBetween('date', [$start_date, $end_date])->where('status', true)->orderBy('supplier_id')->orderBy('category_id')->orderBy('product_id')->get();
        $pdf = PDF::loadView('backend.pdf.purchase-daily-report-pdf', [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'all_data' => $data,
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
