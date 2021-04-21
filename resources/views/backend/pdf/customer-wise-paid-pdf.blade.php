<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Wise Paid List PDF</title>
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
                        <td width="62%"></td>
                        <td>
                            <u>
                                <strong><span style="font-size: 15px;">Customer Wise Paid List</span></strong>
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
                        <th>Invoice no</th>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_sum = 0;
                    @endphp
                    @foreach($all_data as $data)
                    <tr class="{{ $data->id }}">
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $data->customer->name }}</td>
                        <td>Invoice No #{{ $data->invoice->invoice_no }}</td>
                        <td>{{ date('d-m-Y', strtotime($data->invoice->date)) }}</td>
                        <td>{{ $data->paid_amount }} Tk</td>
                    </tr>
                    @php
                    $total_sum += $data->paid_amount;
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="4" style="text-align: right;"><strong>Grand Total</strong></td>
                        <td><strong>{{ $total_sum }} Tk</strong></td>
                    </tr>
                </tbody>
            </table>
            @php
            $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
            @endphp
            Printing Time : {{ $date->format('F d, Y, g:i a') }}
            <br>
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
