<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class InvoiceController extends Controller
{
    //invoice view
    public function view()
    {
        $data = Invoice::where('status', true)->orderBy('id', 'desc')->orderBy('date', 'desc')->get();
        return view('backend.invoice.view-invoice', [
            'all_data' => $data,
        ]);
    }
    //invoice add
    public function add()
    {
        $categories = Category::where('status', true)->get();
        $customers = Customer::all();
        $invoice = Invoice::latest()->first();
        $invoice_no = 0;
        if (@$invoice->invoice_no == 0) {
            $regFirst = 0;
            $invoice_no = $regFirst + 1;
        } else {
            $invoice = Invoice::latest()->first()->invoice_no;
            $invoice_no = $invoice + 1;
        }
        return view('backend.invoice.add-invoice', [
            'categories' => $categories,
            'invoice_no' => $invoice_no,
            'customers' => $customers,
        ]);
    }
    //invoice store
    public function store(Request $request)
    {
        if ($request->category_id != NULL) {
            if ($request->estimated_amount > $request->paid_amount) {
                $invoice = Invoice::create([
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'invoice_no' => $request->invoice_no,
                    'description' => $request->description,
                    'created_by' => Auth::user()->id,
                ]);
                $count_category = count($request->category_id);
                for ($i = 0; $i < $count_category; $i++) {
                    $invoice_detail = new InvoiceDetail();
                    $invoice_detail->date = date('Y-m-d', strtotime($request->date));
                    $invoice_detail->invoice_id = $invoice->id;
                    $invoice_detail->category_id = $request->category_id[$i];
                    $invoice_detail->product_id = $request->product_id[$i];
                    $invoice_detail->selling_qty = $request->selling_qty[$i];
                    $invoice_detail->unit_price = $request->unit_price[$i];
                    $invoice_detail->selling_price = $request->selling_price[$i];
                    $invoice_detail->status = false;
                    $invoice_detail->save();
                }
                if ($request->customer_id == '0') {
                    $customer = Customer::create([
                        'name' => $request->name,
                        'mobile' => $request->mobile,
                        'address' => $request->address,
                        'created_by' => Auth::user()->id,
                    ]);
                }
                $payment = new Payment();
                $payment_detail = new PaymentDetail();
                $payment->invoice_id = $invoice->id;
                $payment->customer_id = $customer->id;
                $payment->paid_status = $request->paid_type;
                $payment->discount_amount = $request->discount_amount;
                $payment->total_amount = $request->estimated_amount;
                if ($request->paid_type == 'full_paid') {
                    $payment->paid_amount = $request->estimated_amount;
                    $payment->due_amount = 0;
                    $payment_detail->current_paid_amount = $request->estimated_amount;
                } elseif ($request->paid_type == 'full_due') {
                    $payment->paid_amount = 0;
                    $payment->due_amount = $request->estimated_amount;;
                    $payment_detail->current_paid_amount = 0;
                } elseif ($request->paid_type == 'partial_paid') {
                    $payment->paid_amount = $request->paid_amount;
                    $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                    $payment_detail->current_paid_amount = $request->paid_amount;
                }
                $payment->save();
                $payment_detail->invoice_id = $invoice->id;
                $payment_detail->date = date('Y-m-d', strtotime($request->date));
                $payment_detail->save();

                return redirect()->back()->with('success', 'Data added successfully ):');
            } else {
                return redirect()->back()->with('error', "Sorry! you paid maximun value.");
            }
        } else {
            return redirect()->back()->with('error', "Sorry! something won't wrong.");
        }
    }
    //invoice pending list
    public function invoicePendingList()
    {
        $data = Invoice::where('status', false)->orderBy('id', 'desc')->orderBy('date', 'desc')->get();
        return view('backend.invoice.invoice-pending-list', [
            'all_data' => $data,
        ]);
    }
    //invoice delete
    public function delete($id)
    {
        $data = Invoice::find($id);
        if ($data != NULL) {
            $data->delete();
            InvoiceDetail::where('invoice_id', $data->id)->delete();
            Payment::where('invoice_id', $data->id)->delete();
            PaymentDetail::where('invoice_id', $data->id)->delete();
            return redirect()->back()->with('success', 'Data deleted successfully ): ');
        }
    }
    //invoice approved
    public function invoiceApproved($id)
    {
        $data = Invoice::find($id);
        return view('backend.invoice.invoice-approved', [
            'data' => $data,
        ]);
    }
    //invoice approved store
    public function invoiceApprovedStore(Request $request, $id)
    {
        foreach ($request->selling_qty as $key => $val) {
            $invoice_detail = InvoiceDetail::where('id', $key)->first();
            $product = Product::where('id', $invoice_detail->product_id)->first();
            if ($product->quantity < $request->selling_qty[$key]) {
                return redirect()->back()->with('error', 'Sorry! you have approve maximum value');
            }
        }
        $invoice = Invoice::find($id);
        $invoice->approved_by = Auth::user()->id;
        $invoice->status = true;

        foreach ($request->selling_qty as $key => $val) {
            $invoice_detail = InvoiceDetail::where('id', $key)->first();
            $invoice_detail->status = true;
            $invoice_detail->update();
            $product = Product::where('id', $invoice_detail->product_id)->first();
            $product->quantity = ((float)$product->quantity - (float)$request->selling_qty[$key]);
            $product->save();
        }
        $invoice->update();
        return redirect()->route('invoices.pending.list')->with('success', 'Data updated successfully ): ');
    }
    //invoice print list
    public function invoicePrintList()
    {
        $data = Invoice::orderBy('id', 'desc')->orderBy('date', 'desc')->where('status', true)->get();
        return view('backend.invoice.invoice-print-list', [
            'all_data' => $data,
        ]);
    }
    //invoice print pdf
    public function invoicePrint($id)
    {
        $data = Invoice::find($id);
        $pdf = PDF::loadView('backend.pdf.invoice-print', [
            'data' => $data,
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    //invoice daily report
    public function invoiceDailyReport()
    {
        return view('backend.invoice.invoice-daily-report');
    }
    //invoice daily report pdf
    public function invoiceDailyReportPdf(Request $request)
    {
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        $data = Invoice::whereBetween('date', [$sdate, $edate])->where('status', true)->get();
        $pdf = PDF::loadView('backend.pdf.daily-invoice-report-pdf', [
            'all_data' => $data,
            'sdate' => $sdate,
            'edate' => $edate,
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
