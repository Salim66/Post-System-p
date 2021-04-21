@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Customers Invoice Edit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    @include('validation')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Edit Invoice (Invoice No #{{ $data->invoice->invoice_no }})

                            </h3>
                            <a href="{{ route('customers.credit') }}" class="btn btn-primary btn-sm float-right"><i
                                    class="fas fa-list"></i> Credit Customer List</a>
                        </div>
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td>Customer Info</td>
                                </tr>
                                <tr>
                                    <td width="30%"><strong>Name : </strong> {{ $data->customer->name }}</td>
                                    <td width="30%"><strong>Mobile : </strong> {{ $data->customer->mobile }}
                                    </td>
                                    <td width="40%" style="text-align: right"><strong>Address : </strong>
                                        {{ $data->customer->address }}</td>
                                </tr>
                            </table>
                            <form action="{{ route('customer.invoice.update', $data->invoice_id) }}" method="POST"
                                id="invoiceUpdateForm">
                                @csrf
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
                                    </tbody>
                                </table><br>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="paid_status">Paid Status</label>
                                        <select name="paid_status" id="paid_status"
                                            class="form-control form-control paid_status">
                                            <option value="">Select Status</option>
                                            <option value="full_paid">Full Paid</option>
                                            <option value="partial_due">Partial Paid</option>
                                        </select>
                                        <input type="text" name="paid_amount"
                                            class="form-control form-control-sm paid_amount"
                                            placeholder="Enter paid amount" style="display: none;">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date">Date</label>
                                        <input type="text" name="date" id="date" class="form-control datepicker"
                                            placeholder="DD-MM-YYYY" readonly>
                                    </div>
                                    <div class="form-group col-md-2" style="margin-top: 30px;">
                                        <button type="submit" class="btn btn-primary">Invoice Update</button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    $(function () {
        $('#invoiceUpdateForm').validate({
        rules: {
            paid_status: {
            required: true,
            },
            date: {
            required: true,
            }
        },
        messages: {

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
        });
    });
</script>
<script>
    $( function() {
      $( ".datepicker" ).datepicker();
    } );
</script>
<script>
    //paid status
     $(document).on('change', '#paid_status', function(){
        var paid_status = $(this).val();
        if(paid_status == 'partial_due'){
            $('.paid_amount').show();
        }else {
            $('.paid_amount').hide();
        }
    });
</script>
@endsection
