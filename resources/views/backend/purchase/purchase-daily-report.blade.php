@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Purchase Daily Report</h1>
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
                                Add Criteria

                            </h3>
                            {{-- <a href="{{ route('purchases.view') }}" class="btn btn-primary btn-sm float-right"><i
                                class="fas fa-list"></i> Purchase List</a> --}}
                        </div>
                        <div class="card-body">
                            <form action="{{ route('purchases.daily.report.pdf') }}" method="GET" id="dprForm"
                                target="_blank">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="start_date">Start Date<span style="color: red;">*</span></label>
                                        <input type="text" name="start_date" id="datepicker" class="form-control"
                                            placeholder="MM-DD-YYYY" autocomplete="off" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="end_date">End Date<span style="color: red;">*</span></label>
                                        <input type="text" name="end_date" id="datepicker1" class="form-control"
                                            placeholder="MM-DD-YYYY" autocomplete="off" readonly>
                                    </div>
                                    <div class="form-group col-md-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
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
        $('#dprForm').validate({
        rules: {
            start_date: {
            required: true,
            },
            end_date: {
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

@endsection
