<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice PDF</title>
</head>

<body>
    <div class="container">
        <div width="100%">
            <table>
                <tr>
                    <td width="20%"><strong>Invoice No:</strong> #{{ $data->invoice_no }}</td>
                    <td width="15%"></td>
                    <td width="30%"><strong>Three Sixty Degree </strong><br> Mirpur-2, Dhaka-1612</td>
                    <td width="35%"><strong>Showroom No: </strong> 01740445607 <br><strong>Owner No:</strong>
                        01773980593</td>
                </tr>
            </table>
            <hr>
            <table>
                <tr>
                    <td width="30%"><strong>Name : </strong> {{ $data->payment->customer->name }}</td>
                    <td width="30%"><strong>Mobile : </strong> {{ $data->payment->customer->mobile }}</td>
                    <td width="40%" style="text-align: right"><strong>Address : </strong>
                        {{ $data->payment->customer->address }}</td>
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
                    @endphp
                    @foreach($data->invoice_detail as $invoice_d)
                    <input type="hidden" name="category_id[]" value="{{ $invoice_d->category_id }}">
                    <input type="hidden" name="product_id[]" value="{{ $invoice_d->product_id }}">
                    <input type="hidden" name="selling_qty[{{ $invoice_d->id }}]" value="{{ $invoice_d->selling_qty }}">
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
                        <td><strong>{{ $data->payment->discount_amount }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: right;">Paid Amount</td>
                        <td><strong>{{ $data->payment->paid_amount }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: right;">Due Amount</td>
                        <td><strong>{{ $data->payment->due_amount }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: right;">Grand Total</td>
                        <td><strong>{{ $data->payment->total_amount }}</strong></td>
                    </tr>
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
