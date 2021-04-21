@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
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
                                Invoice No : #{{ $data->invoice_no }} ({{ date('d-m-Y', strtotime($data->date)) }})

                            </h3>
                            <a href="{{ route('invoices.pending.list') }}" class="btn btn-primary btn-sm float-right"><i
                                    class="fas fa-plus-circle"></i> Invoice pending List</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td width="15%"><strong>Customer Info</strong></td>
                                        <td width="25%"><strong>Name:</strong> {{ $data->payment->customer->name }}</td>
                                        <td width="30%"><strong>Mobile No:</strong>
                                            {{ $data->payment->customer->mobile }}</td>
                                        <td width="30%"><strong>Address:</strong>
                                            {{ $data->payment->customer->address }}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%"></td>
                                        <td width="85%" colspan="3">
                                            <stron>Description:</stron>{{ $data->description }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table><br>
                            <form action="{{ route('invoice.approved.store', $data->id) }}" method="POST">
                                @csrf
                                <table border="1" width="100%" class="text-center">
                                    <thead>
                                        <th>SL.</th>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th style="text-align: center; background-color: #ddd; padding: 1px;">Current
                                            Stock</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Selling Price</th>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total_sum = 0;
                                        @endphp
                                        @foreach($data->invoice_detail as $invoice_d)
                                        <input type="hidden" name="category_id[]" value="{{ $invoice_d->category_id }}">
                                        <input type="hidden" name="product_id[]" value="{{ $invoice_d->product_id }}">
                                        <input type="hidden" name="selling_qty[{{ $invoice_d->id }}]"
                                            value="{{ $invoice_d->selling_qty }}">
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $invoice_d->category->name }}</td>
                                            <td>{{ $invoice_d->product->name }}</td>
                                            <td style="text-align: center; background-color: #ddd; padding: 1px;">
                                                {{ $invoice_d->product->quantity }}</td>
                                            <td>{{ $invoice_d->selling_qty }}</td>
                                            <td>{{ $invoice_d->unit_price }}</td>
                                            <td>{{ $invoice_d->selling_price }}</td>
                                        </tr>
                                        @php
                                        $total_sum += $invoice_d->selling_price;
                                        @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="6" style="text-align: right;"><strong>Sub Total</strong></td>
                                            <td><strong>{{ $total_sum }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="text-align: right;">Discount</td>
                                            <td><strong>{{ $data->payment->discount_amount }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="text-align: right;">Paid Amount</td>
                                            <td><strong>{{ $data->payment->paid_amount }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="text-align: right;">Due Amount</td>
                                            <td><strong>{{ $data->payment->due_amount }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="text-align: right;">Grand Total</td>
                                            <td><strong>{{ $data->payment->total_amount }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="submit" class="btn btn-sm btn-primary mt-4" value="Submit">
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
@endsection
