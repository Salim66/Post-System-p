@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
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
                                Product List

                            </h3>
                            <a href="{{ route('products.add') }}" class="btn btn-primary btn-sm float-right"><i
                                    class="fas fa-plus-circle"></i> Add Product</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Supplier</th>
                                        <th>Unit</th>
                                        <th>Category</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_data as $data)
                                    <tr class="{{ $data->id }}">
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $data->supplier->name }}</td>
                                        <td>{{ $data->unit->name }}</td>
                                        <td>{{ $data->category->name }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->quantity }}</td>
                                        <td>
                                            <a title="Edit" href="{{ route('products.edit', $data->id) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>

                                            <form class="d-inline-block"
                                                action="{{ route('products.delete', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="delete" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>

                                            {{-- <a title="Delete" id="delete"
                                                href="{{ route('suppliers.delete', $data->id) }}"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> --}}
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