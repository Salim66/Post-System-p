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
                                Add Purchase

                            </h3>
                            <a href="{{ route('purchases.view') }}" class="btn btn-primary btn-sm float-right"><i
                                    class="fas fa-list"></i> Purchase List</a>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="date">Date<span style="color: red;">*</span></label>
                                    <input type="text" name="date" id="datepicker" class="form-control"
                                        placeholder="MM-DD-YYYY" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="purchase_no">Purchase No<span style="color: red;">*</span></label>
                                    <input type="text" name="purchase_no" id="purchase_no" class="form-control">
                                </div>
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
                                    <label for="category">Category Name<span style="color:red;">*</span></label>
                                    <select name="category_id" id="category_id" class="form-control select2"
                                        style="width: 100%;">


                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="product_id">Product Name<span style="color:red;">*</span></label>
                                    <select name="product_id" id="product_id" class="form-control select2"
                                        style="width: 100%;">

                                    </select>
                                </div>
                                <div class="form-group col-md-2" style="margin-top: 30px;">
                                    <span title="Add Item" class="btn btn-sm btn-success addeventmore"
                                        id="addeventmore"><i class="fas fa-plus-circle"></i></span>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                        <div class="card-body">
                            <form action="{{ route('purchases.store') }}" method="POST">
                                @csrf
                                <table class="table-sm table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th width="7%">pcs/kg</th>
                                            <th width="10%">Unit Price</th>
                                            <th>Description</th>
                                            <th width="10%">Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="addRow" id="addRow">

                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td>
                                                <input type="text" name="estimated_amount" id="estimated_amount"
                                                    class="form-control form-control-sm text-right estimated_amount"
                                                    style="background-color: #D8FDBA" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table><br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-primary">Purchase store</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </section>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script id="document_template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
        <input type="hidden" name="date[]" value="@{{ date }}">
        <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
        <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
        <td>
            <input type="hidden" name="category_id[]" value="@{{ category_id }}">
            @{{ category_name }}
        </td>
        <td>
            <input type="hidden" name="product_id[]" value="@{{ product_id }}">
            @{{ product_name }}
        </td>
        <td>
            <input type="number" min="1" name="buying_qty[]" class="form-control form-control-sm text-right buying_qty" value="1">
        </td>
        <td>
            <input type="number" name="unit_price[]" class="form-control form-control-sm text-right unit_price" value="">
        </td>
        <td>
            <input type="text" name="description[]" class="form-control form-control-sm">
        </td>
        <td>
            <input type="number" name="buying_price[]" class="form-control form-control-sm text-right buying_price" value="0">
        </td>
        <td>
            <i class="btn btn-sm btn-danger fa fa-window-close closeeventmore"></i>
        </td>
    </tr>
</script>


<script>
    $(function(){
        $(document).ready(function () {
            $(document).on('click', '#addeventmore', function(){
                var date = $('#datepicker').val();
                var purchase_no   = $('#purchase_no').val();
                var supplier_id   = $('#supplier_id').val();
                var category_id   = $('#category_id').val();
                var category_name = $('#category_id').find('option:selected').text();
                var product_id    = $('#product_id').val();
                var product_name  = $('#product_id').find('option:selected').text();

                if(date == ''){
                    $.notify("Date is required", {globalPosition:'top right', className: 'error'});
                    return false;
                }
                if(purchase_no == ''){
                    $.notify("Purchase no is required", {globalPosition:'top right', className: 'error'});
                    return false;
                }
                if(supplier_id == ''){
                    $.notify("Supplier is required", {globalPosition:'top right', className: 'error'});
                    return false;
                }
                if(category_id == ''){
                    $.notify("Category is required", {globalPosition:'top right', className: 'error'});
                    return false;
                }
                if(product_id == ''){
                    $.notify("Product is required", {globalPosition:'top right', className: 'error'});
                    return false;
                }

                var source = $('#document_template').html();
                var template = Handlebars.compile(source);

                var date = {
                    date: date,
                    purchase_no: purchase_no,
                    supplier_id: supplier_id,
                    category_id: category_id,
                    category_name: category_name,
                    product_id: product_id,
                    product_name: product_name,
                }
                var html = template(date);
                $('#addRow').append(html);
            });

            $(document).on('click', '.closeeventmore', function(){
                $(this).closest('#delete_add_more_item').remove();
                totalAmountPrice();
            });

            $(document).on('keyup click', '.unit_price,.buying_qty', function(){
                var unit_price = $(this).closest('tr').find('input.unit_price').val();
                var qty = $(this).closest('tr').find('input.buying_qty').val();
                var total = unit_price * qty;
                $(this).closest('tr').find('.buying_price').val(total);
                totalAmountPrice();
            });

            function totalAmountPrice(params) {
                var sum = 0;
                $('.buying_price').each(function() {
                    var value = $(this).val();
                    if(!isNaN(value) && value.length != 0){
                        sum += parseFloat(value);
                    }
                })
                $('.estimated_amount').val(sum);
            }
        });
    });
</script>

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


<script>
    $(function(){
        <!-- Supplier wise category select script -->
        $(document).on('change', '#supplier_id', function(){
            var supplier_id = $(this).val();


            $.ajax({
                url: "{{ route('supplier.wise.cateogry') }}",
                type:"GET",
                data:{supplier_id:supplier_id},
                success: function(data){
                    let html = '<option value="">Select Category</option>';
                    $.each(data, function(key, v){
                        html += '<option value="'+v.category_id+'">'+v.category.name+'</option>'
                    });

                    $('#category_id').html(html);
                }
            });
        });


        <!-- Category wise Product select script -->
        $(document).on('change', '#category_id', function(){
            var category_id = $(this).val();


            $.ajax({
                url: "{{ route('category.wise.product') }}",
                type:"GET",
                data:{category_id:category_id},
                success: function(data){
                    let html = '<option value="">Select Product</option>';
                    $.each(data, function(key, v){
                        html += '<option value="'+v.id+'">'+v.name+'</option>'
                    });

                    $('#product_id').html(html);
                }
            });
        });
    });
</script>

@endsection