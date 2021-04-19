@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Suppliers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Suppliers</li>
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
                                Edit Suppliers

                            </h3>
                            <a href="{{ route('suppliers.view') }}" class="btn btn-primary btn-sm float-right"><i
                                    class="fas fa-list"></i> Suppliers List</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('suppliers.update', $data->id) }}" method="POST" id="supplierForm">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="name">Company Name<span style="color: red;">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ $data->name }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="mobile">Mobile<span style="color: red;">*</span></label>
                                        <input type="text" name="mobile" class="form-control"
                                            value="{{ $data->mobile }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $data->email }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="address">Address<span style="color: red;">*</span></label>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $data->address }}">
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
        $('#supplierForm').validate({
        rules: {
            name: {
            required: true,
            },
            mobile: {
            required: true,
            },
            address: {
            required: true,
            },
        },
        messages: {
            name: {
                required: 'The name field is required!'
            },
            mobile: {
                required: 'The mobile field is required!'
            },
            address: {
                required: 'The address field is required!'
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
