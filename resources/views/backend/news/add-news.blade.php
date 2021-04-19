@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage News and Event</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">News and Event</li>
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
                                Add News and Event

                            </h3>
                            <a href="{{ route('news_event.view') }}" class="btn btn-primary btn-sm float-right"><i
                                    class="fas fa-list"></i> News and Event List</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('news_event.store') }}" method="POST" id="myForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="date">Date</label>
                                        <input type="text" name="date" id="datepicker" class="form-control"
                                            placeholder="YYYY-MM-DD" readonly>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Title">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="sub_title">Sub Title</label>
                                        <textarea type="text" name="sub_title" class="form-control" rows="6"></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="address">Upload Image</label>
                                        <input type="file" name="image" class="form-control" id="news_image">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <img id="news_image_src" src=""
                                            style="border: 1px solid #000; width:100px; height:100px" alt="">
                                    </div>
                                    <div class="form-group col-md-6">
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
@endsection
