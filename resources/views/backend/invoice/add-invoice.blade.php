@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Invoice</h1>
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
                                Add Invoice

                            </h3>
                            <a href="{{ route('invoices.view') }}" class="btn btn-primary btn-sm float-right"><i
                                    class="fas fa-list"></i> Invoice List</a>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-1">
                                    <label for="invoice_no">In.No<span style="color: red;">*</span></label>
                                    <input type="text" name="invoice_no" id="invoice_no"
                                        class="form-control form-control-sm" readonly style="background-color: #D8FDBA;"
                                        value="{{ $invoice_no }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="date">Date<span style="color: red;">*</span></label>
                                    <input type="text" name="date" id="datepicker" class="form-control form-control-sm"
                                        placeholder="MM-DD-YYYY" readonly value="{{ date('m-d-Y') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="category">Category Name<span style="color:red;">*</span></label>
                                    <select name="category_id" id="category_id"
                                        class="form-control form-control-sm select2" style="width: 100%;">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="product_id">Product Name<span style="color:red;">*</span></label>
                                    <select name="product_id" id="product_id"
                                        class="form-control form-control-sm select2" style="width: 100%;">

                                    </select>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="quantity">Quantity<span style="color: red;">*</span></label>
                                    <input type="text" name="quantity" id="quantity"
                                        class="form-control form-control-sm" readonly style="background-color: #D8FDBA">
                                </div>
                                <div class="form-group col-md-2" style="margin-top: 30px;">
                                    <span title="Add Item" class="btn btn-sm btn-success addeventmore"
                                        id="addeventmore"><i class="fas fa-plus-circle"></i></span>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                        <div class="card-body">
                            <form action="{{ route('invoices.store') }}" method="POST">
                                @csrf
                                <table class="table-sm table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th width="7%">pcs/kg</th>
                                            <th width="10%">Unit Price</th>
                                            <th width="17%">Total Price</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="addRow" id="addRow">

                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td class="text-right" colspan="4">Discount</td>
                                            <td>
                                                <input type="text" name="discount_amount" id="discount_amount"
                                                    class="form-control form-control-sm discount_amount"
                                                    placeholder="Write discount amount"
                                                    style="background-color: #e6f8d6;">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td>
                                                <input type="text" name="estimated_amount" id="estimated_amount"
                                                    class="form-control form-control-sm text-right estimated_amount"
                                                    style="background-color: #D8FDBA" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table><br>
                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" rows="2" class="form-control"
                                        placeholder="Write your description...."></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Paid Type</label>
                                        <select name="paid_type" id="paid_type"
                                            class="form-control form-control-sm paid_type">
                                            <option value="">Select Type</option>
                                            <option value="full_paid">Full Paid</option>
                                            <option value="full_due">Full Due</option>
                                            <option value="partial_paid">Purtial Paid</option>
                                        </select>
                                        <input type="text" name="paid_amount"
                                            class="form-control form-control-sm paid_amount" id="paid_amount"
                                            style="display: none;">
                                    </div>
                                    <div class="form-group col-md-9">
                                        <label>Customer Name</label>
                                        <select name="customer_id" id="customer_id"
                                            class="form-control form-control-sm select2">
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}
                                                ({{ $customer->mobile }} - {{ $customer->address }})</option>
                                            @endforeach
                                            <option value="0">New Customer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row" id="new_customer" style="display: none;">
                                    <div class="form-group col-md-4">
                                        <label>Customer Name</label>
                                        <input type="text" name="name" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Mobile</label>
                                        <input type="text" name="mobile" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-primary">Invoice store</button>
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
        <input type="hidden" name="date" value="@{{ date }}">
        <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">
        <td>
            <input type="hidden" name="category_id[]" value="@{{ category_id }}">
            @{{ category_name }}
        </td>
        <td>
            <input type="hidden" name="product_id[]" value="@{{ product_id }}">
            @{{ product_name }}
        </td>
        <td>
            <input type="number" min="1" name="selling_qty[]" class="form-control form-control-sm text-right selling_qty" value="1">
        </td>
        <td>
            <input type="number" name="unit_price[]" class="form-control form-control-sm text-right unit_price" value="">
        </td>
        <td>
            <input type="number" name="selling_price[]" class="form-control form-control-sm text-right selling_price" value="0">
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
                var invoice_no    = $('#invoice_no').val();
                var category_id   = $('#category_id').val();
                var category_name = $('#category_id').find('option:selected').text();
                var product_id    = $('#product_id').val();
                var product_name  = $('#product_id').find('option:selected').text();

                if(date == ''){
                    $.notify("Date is required", {globalPosition:'top right', className: 'error'});
                    return false;
                }
                if(invoice_no == ''){
                    $.notify("Invoice no is required", {globalPosition:'top right', className: 'error'});
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
                    invoice_no: invoice_no,
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

            $(document).on('keyup click', '.unit_price,.selling_qty', function(){
                var unit_price = $(this).closest('tr').find('input.unit_price').val();
                var qty = $(this).closest('tr').find('input.selling_qty').val();
                var total = unit_price * qty;
                $(this).closest('tr').find('.selling_price').val(total);
                $('.discount_amount').trigger('keyup');
            });

            $(document).on('keyup', '.discount_amount', function(){
                totalAmountPrice();
            });

            function totalAmountPrice(params) {
                var sum = 0;
                $('.selling_price').each(function() {
                    var value = $(this).val();
                    if(!isNaN(value) && value.length != 0){
                        sum += parseFloat(value);
                    }
                });

                var discount_amount = parseFloat($('.discount_amount').val());
                if(!isNaN(discount_amount) && discount_amount.length != 0){
                    sum -= parseFloat(discount_amount);
                }

                $('.estimated_amount').val(sum);
            }

        });
    });
</script>

<script>
    $(function(){
        <!-- Product wise quantity -->
        $(document).on('change', '#product_id', function(){
            var product_id = $(this).val();


            $.ajax({
                url: "{{ route('product.quantity') }}",
                type:"GET",
                data:{product_id:product_id},
                success: function(data){
                    $('#quantity').val(data);
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

        //paid status
        $(document).on('change', '#paid_type', function (e) {
            var paid_type = $(this).val();
            if(paid_type == 'partial_paid'){
                $('#paid_amount').show();
            }else {
                $('#paid_amount').hide();
            }
        });

        //new customer
        $(document).on('change', '#customer_id', function (e) {
            var customer_id = $(this).val();
            if(customer_id == '0'){
                $('#new_customer').show();
            }else {
                $('#new_customer').hide();
            }
        });

    });
</script>

@endsection
