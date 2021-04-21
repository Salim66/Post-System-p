<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Invoice PDF</title>
</head>

<body>
    <div class="container">
        <div width="100%">
            <table>
                <tr>
                    <td width="25%"></td>
                    <td>
                        <span style="font-size: 20px;background: #1781BF;padding: 3px 10px 3px 10px; color: #fff;">Three
                            Sixty Degree</span><br>
                        Mirpur-2, Dhaka
                    </td>
                    <td><span>Showroom No: 01740445607 <br>Owner No:
                            01773980593</span> </td>
                </tr>
            </table>
            <hr>
            <table>
                <tbody>
                    <tr>
                        <td width="25%"></td>
                        <td>
                            <u>
                                <strong><span style="font-size: 15px;">Daily Invoice
                                        Report({{date('d-m-Y',strtotime($sdate))}} -
                                        {{date('d-m-Y',strtotime($edate))}})</span></strong>
                            </u>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table><br>
            <table border="1" width="100%" style="text-align: center;">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Customer Name</th>
                        <th>Invoice No</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_sum = 0;
                    @endphp
                    @foreach($all_data as $data)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $data->payment->customer->name }}</td>
                        <td>Invoice NO #{{ $data->invoice_no }}</td>
                        <td>{{ date('d-m-Y', strtotime($data->date)) }}</td>
                        <td>{{ $data->description }}</td>
                        <td>{{ $data->payment->total_amount }}</td>
                    </tr>
                    @php
                    $total_sum += $data->payment->total_amount;
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="5" style="text-align: right;"><strong>Grand Total</strong></td>
                        <td><strong>{{ $total_sum }}</strong></td>
                    </tr>
                </tbody>
            </table><br>
            <table border="0" width="100%">
                <tbody>
                    <tr>
                        <td style="width: 40px;">
                        </td>
                        <td style="width: 20%; "></td>
                        <td style="width: 40%; text-align: right;">
                            <p style="text-align: right; border-bottom: 1px solid #000;">Owner Signature</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>


</body>

</html>
