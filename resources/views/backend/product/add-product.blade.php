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
                                Add Product

                            </h3>
                            <a href="{{ route('products.view') }}" class="btn btn-primary btn-sm float-right"><i
                                    class="fas fa-list"></i> Product List</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.store') }}" method="POST" id="productForm">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="supplier">Supplier Name<span style="color:red;">*</span></label>
                                        <select name="supplier_id" id="supplier_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">Select Supplier</option>
                                            @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="unit">Unit Name<span style="color:red;">*</span></label>
                                        <select name="unit_id" id="unit_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="category">Category Name<span style="color:red;">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">Product Name<span style="color: red;">*</span></label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top: 30px;">
                                        <input type="submit" name="submit" class="btn btn-success" value="Submit">
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
        $('#productForm').validate({
        rules: {
            supplier_id: {
            required: true,
            },
            unit_id: {
            required: true,
            },
            category_id: {
            required: true,
            },
            name: {
            required: true,
            },
        },
        messages: {
            name: {
                required: 'The name field is required!'
            },
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
@endsection