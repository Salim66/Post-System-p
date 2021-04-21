@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Invoice Pending List</h1>
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
                                Invoice pending List

                            </h3>
                            {{-- <a href="{{ route('invoices.add') }}" class="btn btn-primary btn-sm float-right"><i
                                class="fas fa-plus-circle"></i> Add Invoice</a> --}}
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Customer Name</th>
                                        <th>Invoice No</th>
                                        <th>date</th>
                                        <th>Description</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_data as $data)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ @$data->payment->customer->name }}</td>
                                        <td>Invoice NO #{{ $data->invoice_no }}</td>
                                        <td>{{ date('d-m-Y', strtotime($data->date)) }}</td>
                                        <td>{{ $data->description }}</td>
                                        <td>{{ @$data->payment->total_amount }}</td>
                                        <td>
                                            @if($data->status == true)
                                            <span class="badge badge-success">Approved</span>
                                            @elseif($data->status == false)
                                            <span class="badge badge-danger">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->status == false)
                                            <a title="Approved" href="{{ route('invoices.approved', $data->id) }}"
                                                class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('invoices.delete', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button title="Delete" type="submit" id="delete"
                                                    class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
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
