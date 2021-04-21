@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Supplier/Product Wise Stock</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Supplier/Product</li>
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
                                    <strong>Supplier wise report</strong>
                                    <input type="radio" name="supplier_product_wise" value="supplier_wise"
                                        class="search_value">&nbsp;&nbsp;
                                    <strong>Product wise report</strong>
                                    <input type="radio" name="supplier_product_wise" value="product_wise"
                                        class="search_value">
                                </div>
                            </div>
                            <hr style="padding-bottom: 0px;">
                            <div class="show_supplier" style="display: none;">
                                <form action="{{ route('supplier.wise.stock.report.pdf') }}" method="GET"
                                    target="_blank" id="suppWForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label>Supplier Name</label>
                                            <select name="supplier_id" id="" class="form-control select2">
                                                <option value="">Select Supplier</option>
                                                @foreach($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4" style="margin-top: 30px;">
                                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="show_product" style="display: none;">
                                <form action="{{ route('product.wise.stock.report.pdf') }}" method="GET" target="_blank"
                                    id="ProWForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Category Name</label>
                                            <select name="category_id" id="category_id" class="form-control select2"
                                                style="width: 100%;">
                                                <option value="" readonly>Select Category</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Product Name</label>
                                            <select name="product_id" id="product_id" class="form-control select2"
                                                style="width: 100%;">

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
            if(search_value == 'supplier_wise'){
                $('.show_supplier').show();
            }else{
                $('.show_supplier').hide();
            }
        });

        //Product/category wise
        $(document).on('change', '.search_value', function(){
            const search_value = $(this).val();
            if(search_value == 'product_wise'){
                $('.show_product').show();
            }else{
                $('.show_product').hide();
            }
        });
    });
</script>

<script>
    $(function () {
        $('#suppWForm').validate({
        rules: {
            supplier_id: {
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
        $('#ProWForm').validate({
        rules: {
            category_id: {
            required: true,
            },
            product_id: {
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
    (function($){
         $(document).ready(function () {

            //select category product
            $(document).on('change', '#category_id', function(){
                var category_id = $(this).val();
                $.ajax({
                    url: "/category-wise-product",
                    type: "GET",
                    data: {category_id:category_id},
                    success: function (data) {
                        var html = '<option value="" readonly>Select Product</option>';
                        $.each(data, function(key, v){
                            html += '<option value="'+v.id+'">'+v.name+'</option>';
                        });
                        $('#product_id').html(html);
                    }
                });
            });

         });
    })(jQuery);
</script>
@endsection
