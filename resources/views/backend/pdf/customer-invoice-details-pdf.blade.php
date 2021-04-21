<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Invoice Detials PDF</title>
</head>

<body>
    <div class="container">
        <div width="100%">
            <table>
                <tr>
                    <td width="20%"><strong>Invoice No:</strong> #{{ $data->invoice->invoice_no }}</td>
                    <td width="15%"></td>
                    <td width="30%"><strong>Three Sixty Degree </strong><br> Mirpur-2, Dhaka-1612</td>
                    <td width="35%"><strong>Showroom No: </strong> 01740445607 <br><strong>Owner No:</strong>
                        01773980593</td>
                </tr>
            </table>
            <hr>
            <table>
                <tr>
                    <td width="30%"><strong>Name : </strong> {{ $data->customer->name }}</td>
                    <td width="30%"><strong>Mobile : </strong> {{ $data->customer->mobile }}</td>
                    <td width="40%" style="text-align: right"><strong>Address : </strong>
                        {{ $data->customer->address }}</td>
                </tr>
            </table>
            <table border="1" width="100%" style="text-align: center;">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Selling Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_sum = 0;
                    $invoice_detials = App\Models\InvoiceDetail::where('invoice_id',
                    $data->invoice_id)->get();
                    @endphp
                    @foreach($invoice_detials as $invoice_d)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $invoice_d->category->name }}</td>
                        <td>{{ $invoice_d->product->name }}</td>
                        <td>{{ $invoice_d->selling_qty }}</td>
                        <td>{{ $invoice_d->unit_price }}</td>
                        <td>{{ $invoice_d->selling_price }}</td>
                    </tr>
                    @php
                    $total_sum += $invoice_d->selling_price;
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="5" style="text-align: right;"><strong>Sub Total</strong></td>
                        <td><strong>{{ $total_sum }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: right;">Discount</td>
                        <td><strong>{{ $data->discount_amount }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: right;">Paid Amount</td>
                        <td><strong>{{ $data->paid_amount }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: right;">Due Amount</td>
                        <input type="hidden" name="new_paid_amount" value="{{ $data->due_amount }}">
                        <td><strong>{{ $data->due_amount }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: right;">Grand Total</td>
                        <td><strong>{{ $data->total_amount }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="text-align: center; font-weight:bold;">Paid Summary</td>
                    </tr>
                    <tr>
                        <td colspan="3">Date</td>
                        <td colspan="3">Amount</td>
                    </tr>
                    @php
                    $payment_details = App\Models\PaymentDetail::where('invoice_id', $data->invoice_id)->get();
                    @endphp
                    @foreach($payment_details as $payment)
                    <tr>
                        <td colspan="3">{{ date('d-m-Y', strtotime($payment->date)) }}</td>
                        <td colspan="3">{{ $payment->current_paid_amount }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table><br>
            <table>
                @php
                $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                @endphp
                <tr>
                    <td>Printing Time: {{ $date->format('F d, Y, g:i a') }}</td>
                </tr>
            </table>
            <hr style="margin-bottom: 0px;">
            <table border="0" width="100%">
                <tbody>
                    <tr>
                        <td style="width: 40px;">
                            <p style="text-align: center; margin-left: 20px;">Customer Signature</p>
                        </td>
                        <td style="width: 20%; "></td>
                        <td style="width: 40%; text-align: center;">
                            <p style="text-align: center;">Seller Signature</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>


</body>

</html>
