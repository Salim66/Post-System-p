<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Report PDF</title>
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
                        <td width="70%"></td>
                        <td>
                            <u>
                                <strong><span style="font-size: 15px;">Stock Report</span></strong>
                            </u>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table><br>
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Supplier Name</th>
                        <th>Category Name</th>
                        <th>Product Name</th>
                        <th>In.Qty</th>
                        <th>Out.Qty</th>
                        <th>quantity</th>
                        <th>Unit Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_data as $data)
                    @php
                    $buyiny_total = App\Models\Purchase::where('product_id',
                    $data->id)->where('category_id', $data->category_id)->sum('buying_qty');
                    $selling_total = App\Models\InvoiceDetail::where('product_id',
                    $data->id)->where('category_id', $data->category_id)->sum('selling_qty');
                    @endphp
                    <tr class="{{ $data->id }}">
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $data->supplier->name }}</td>
                        <td>{{ $data->category->name }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $buyiny_total }}</td>
                        <td>{{ $selling_total }}</td>
                        <td>{{ $data->quantity }}</td>
                        <td>{{ $data->unit->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
