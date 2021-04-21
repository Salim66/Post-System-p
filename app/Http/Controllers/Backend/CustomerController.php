<?php

namespace App\Http\Controllers\Backend;

use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;

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
    //credit customer list
    public function creditCustomerList()
    {
        $data = Payment::whereIn('paid_status', ['full_due', 'partial_due'])->get();
        return view('backend.customer.credit-customer-list', [
            'all_data' => $data
        ]);
    }
    //credit customer list pdf
    public function creditCustomerListPdf()
    {
        $data = Payment::whereIn('paid_status', ['full_due', 'partial_due'])->get();
        $pdf  = PDF::loadView('backend.pdf.credit-customer-list-pdf', [
            'all_data' => $data,
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    //customer invoice edit
    public function customerInvoiceEdit($invoice_id)
    {
        $data = Payment::where('invoice_id', $invoice_id)->first();
        return view('backend.customer.customer-invoice-edit', [
            'data' => $data,
        ]);
    }
    //customer invoice update
    public function customerInvoiceUpdate(Request $request, $invoice_id)
    {
        if ($request->new_paid_amount < $request->paid_amount) {
            return redirect()->back()->with('error', 'Sorry! you have paid maximum value');
        } else {
            $payment = Payment::where('invoice_id', $invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if ($request->paid_status == 'full_paid') {
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount'] + $request->new_paid_amount;
                $payment->due_amount = 0;
                $payment_details->current_paid_amount = $request->new_paid_amount;
            } elseif ($request->paid_status == 'partial_due') {
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount'] + $request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id', $invoice_id)->first()['due_amount'] - $request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d', strtotime($request->date));
            $payment_details->save();

            return redirect()->route('customers.credit')->with('success', 'Invoice updated successfully ): ');
        }
    }
    //customer invoice details
    public function customerInvoiceDetailsPdf($invoice_id)
    {
        $data = Payment::where('invoice_id', $invoice_id)->first();
        $pdf  = PDF::loadView('backend.pdf.customer-invoice-details-pdf', [
            'data' => $data,
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    //credit customer list
    public function paidCustomerList()
    {
        $data = Payment::where('paid_status', '!=', 'full_due')->get();
        return view('backend.customer.paid-customer-list', [
            'all_data' => $data
        ]);
    }
    //customer paid list pdf
    public function paidCustomerListPdf()
    {
        $data = Payment::where('paid_status', '!=', 'full_due')->get();
        $pdf  = PDF::loadView('backend.pdf.paid-customer-list-pdf', [
            'all_data' => $data,
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    //customer wise report
    public function customerWiseReport()
    {
        $customers = Customer::all();
        return view('backend.customer.customer-wise-report', [
            'customers' => $customers
        ]);
    }
    //customer wise credit list pdf
    public function customerWiseCreditReport(Request $request)
    {
        $data = Payment::where('customer_id', $request->customer_id)->whereIn('paid_status', ['full_due', 'partial_due'])->get();
        $pdf  = PDF::loadView('backend.pdf.customer-wise-credit-pdf', [
            'all_data' => $data,
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    //customer wise paid list pdf
    public function customerWisePaidReport(Request $request)
    {
        $data = Payment::where('customer_id', $request->customer_id)->where('paid_status', '!=', 'full_due')->get();
        $pdf  = PDF::loadView('backend.pdf.customer-wise-paid-pdf', [
            'all_data' => $data,
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
