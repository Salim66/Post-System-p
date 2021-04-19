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
                        News and Event List

                    </h3>
                    <a href="{{ route('news_event.add') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus-circle"></i> Add News and Event</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Sub Title</th>
                            <th>Image</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($all_news as $news)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $news->date }}</td>
                                <td>{{ $news->title }}</td>
                                <td>{{ Str::words($news->sub_title, 20, '...') }}</td>
                                <td><img src="{{ ($news->image) ? URL::to('upload/news_images/'.$news->image) :  URL::to('upload/no-image-found.png')}}" alt="" width="50px" width="50px"></td>
                                <td>
                                    <a href="{{ route('news_event.edit', $news->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <a id="user_delete" href="{{ route('news_event.delete', $news->id) }}"   class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
