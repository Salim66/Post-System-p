@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
            @php
                $user = Auth::user();
            @endphp

            @include('validation')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Edit Profile

                    </h3>
                    <a href="{{ route('profile.view') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-list"></i> Profile</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $user -> name }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" required value="{{ $user -> email }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="mobile">Mobile</label>
                                <input type="text" name="mobile" class="form-control" required value="{{ $user -> mobile }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" required value="{{ $user -> address }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ ($user -> gender == "Male") ? "selected" : "" }}>Male</option>
                                    <option value="Female" {{ ($user -> gender == "Female") ? "selected" : "" }}>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="address">Profile Photo</label>
                                <input type="file" name="image" class="form-control" id="user_image" >
                            </div>
                            <div class="form-group col-md-4">
                                <img id="image_src" src="{{ URL::to('/') }}/upload/user_images/{{ $user -> image }}" style="border: 1px solid #000; width:100px; height:100px" alt="">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="submit" name="submit" class="btn btn-success" style="margin-top: 60px; margin-left:-150px;" value="Update">
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
