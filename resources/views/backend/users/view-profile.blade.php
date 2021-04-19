@extends('backend.layouts.app')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @include('validation')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-4 connectedSortable offset-4">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ (Auth::user()->image) ? URL::to('upload/user_images/'.Auth::user()->image) :  URL::to('upload/no-image-found.png')}}"
                         alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                  <p class="text-muted text-center">{{ Auth::user()->address }}</p>

                  <table class="table table-striped">
                      <tbody>
                          <tr>
                              <td>Email</td>
                              <td>{{ Auth::user()->email }}</td>
                          </tr>
                          <tr>
                              <td>Mobile</td>
                              <td>{{ Auth::user()->mobile }}</td>
                          </tr>
                          <tr>
                              <td>Gender</td>
                              <td>{{ Auth::user()->gender }}</td>
                          </tr>
                      </tbody>
                  </table>

                  <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block mt-2"><b>Edit Profile</b></a>
                </div>
                <!-- /.card-body -->
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
