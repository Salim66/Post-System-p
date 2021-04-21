<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Daily Report</title>
</head>

<body>
    <table>
        <tr>
            <td width="30%"></td>
            <td>
                <h2 style="background-color: #acf080; padding: 10px; border: 5px; color: white;">Three Sixty
                    Degree</h2>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mirpur-2, Dhaka-1216
            </td>
            <td width="5%"></td>
            <td>
                <span><strong>Showroom No : </strong>01773980593<br>
                    <strong>Owner No : </strong>01740445607</span>
            </td>
        </tr>
    </table>
    <hr style="padding-bottom: 0px;">
    <table>
        <tr>
            <td width="28%"></td>
            <td>
                <u><strong>Daily Purchase Report </strong>({{ $start_date }} - {{ $end_date }})</u>
            </td>
        </tr>
    </table><br>
    <table width="100%" border="1">
        <thead>
            <tr>
                <th>SL</th>
                <th>Purchase No</th>
                <th>Date</th>
                <th>Product</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Buying Price</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total = 0;
            @endphp
            @foreach ($all_data as $data)
            <tr class="{{ $data->id }}">
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $data->purchase_no }}</td>
                <td>{{ $data->date }}</td>
                <td>{{ $data->product->name }}</td>
                <td>{{ $data->category->name }}</td>
                <td>{{ $data->supplier->name }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->buying_qty }}</td>
                <td>{{ $data->unit_price }}</td>
                <td>{{ $data->buying_price }}</td>
                @php
                $total += $data->buying_price;
                @endphp
            </tr>
            @endforeach
            <tr>
                <td colspan="9" style="text-align: right;"><strong>Grand Total</strong></td>
                <td><strong>{{ $total }}</strong></td>
            </tr>
        </tbody>
    </table>
    @php
    $date = new DateTime('now', new DateTimezone('Asia/Dhaka'))
    @endphp
    <table>
        <tr>
            <td>Printing Time : {{ $date->format('F d, Y, g:i a') }}</td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="60%"></td>
            <td style="text-align: center; border-bottom: 1px solid #000;" width="10%">Owner Signeture</td>
        </tr>
    </table>
</body>

</html>
