@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Purchase</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Purchase</li>
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
                                Purchase Pending List

                            </h3>
                            <a href="{{ route('purchases.add') }}" class="btn btn-primary btn-sm float-right"><i
                                    class="fas fa-plus-circle"></i> Add Purchase</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover table-responsive">
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
                                        <th>Status</th>
                                        <th width="6%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        <td>
                                            @if($data->status == false)
                                            <span class="badge badge-danger">Pending</span>
                                            @elseif ($data->status == true)
                                            <span class="badge badge-success">Approved</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->status == false)
                                            <a title="Approved" id="approved"
                                                href="{{ route('purchases.approved', $data->id) }}"
                                                class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i></a>
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