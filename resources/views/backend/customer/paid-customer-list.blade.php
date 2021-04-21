@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Paid Customers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customers/Paid</li>
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
                                Paid Customer List

                            </h3>
                            <a href="{{ route('customers.paid.pdf') }}" target="_blank"
                                class="btn btn-primary btn-sm float-right"><i class="fas fa-download"></i> Dowonload
                                PDF</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Customer Name</th>
                                        <th>Invoice no</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total_sum = 0;
                                    @endphp
                                    @foreach ($all_data as $data)
                                    <tr class="{{ $data->id }}">
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $data->customer->name }}</td>
                                        <td>Invoice No #{{ $data->invoice->invoice_no }}</td>
                                        <td>{{ date('d-m-Y', strtotime($data->invoice->date)) }}</td>
                                        <td>{{ $data->due_amount }} Tk</td>
                                        <td>
                                            <a title="Edit"
                                                href="{{ route('customer.invoice.edit', $data->invoice_id) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <a title="Details"
                                                href="{{ route('customer.invoice.details.pdf', $data->invoice_id) }}"
                                                class="btn btn-success btn-sm" target="_blank"><i
                                                    class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                    $total_sum += $data->due_amount;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <td colspan="4" style="text-align: right;"><strong>Grand Total</strong></td>
                                    <td><strong>{{ $total_sum }} Tk</strong></td>
                                </tbody>
                            </table>
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
