@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Customer Wise Stock</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customer</li>
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
                                Select Criteria

                            </h3>
                            {{-- <a href="{{ route('stocks.report.pdf') }}" class="btn btn-primary btn-sm
                            float-right"><i class="fas fa-download"></i> Download PDF</a> --}}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <strong>Customer credit wise report</strong>
                                    <input type="radio" name="customer_wise_report" value="customer_credit_wise"
                                        class="search_value">&nbsp;&nbsp;
                                    <strong>Customer paid wise report</strong>
                                    <input type="radio" name="customer_wise_report" value="customer_paid_wise"
                                        class="search_value">
                                </div>
                            </div>
                            <hr style="padding-bottom: 0px;">
                            <div class="show_customer_credit" style="display: none;">
                                <form action="{{ route('customers.wise.credit.report') }}" method="GET" target="_blank"
                                    id="custCreditWForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label>Customer Name</label>
                                            <select name="customer_id" id="" class="form-control select2">
                                                <option value="">Select Customer</option>
                                                @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}
                                                    ({{ $customer->mobile }} - {{ $customer->address }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4" style="margin-top: 30px;">
                                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="show_customer_paid" style="display: none;">
                                <form action="{{ route('customers.wise.paid.report') }}" method="GET" target="_blank"
                                    id="custPaidWForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label>Customer Name</label>
                                            <select name="customer_id" id="" class="form-control select2">
                                                <option value="">Select Customer</option>
                                                @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}
                                                    ({{ $customer->mobile }} - {{ $customer->address }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2" style="margin-top: 30px;">
                                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
<script type="text/javascript">
    $(function(){
        //Supplier wise
        $(document).on('change', '.search_value', function(){
            const search_value = $(this).val();
            if(search_value == 'customer_credit_wise'){
                $('.show_customer_credit').show();
            }else{
                $('.show_customer_credit').hide();
            }
        });

        //Product/category wise
        $(document).on('change', '.search_value', function(){
            const search_value = $(this).val();
            if(search_value == 'customer_paid_wise'){
                $('.show_customer_paid').show();
            }else{
                $('.show_customer_paid').hide();
            }
        });
    });
</script>


<script>
    $(function () {
        $('#custCreditWForm').validate({
        rules: {
            customer_id: {
            required: true,
            },
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
    $(function () {
        $('#custPaidWForm').validate({
        rules: {
            customer_id: {
            required: true,
            },
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
