@if($errors->any())
    @foreach ($errors->all() as $error)
     <p style="border-left-color: rgb(19, 218, 19);"  class="alert alert-danger">{{ $error }} <button class="close" data-dismiss="alert">&times;</button></p>
    @endforeach
@endif

@if (Session::has('success'))
<p style="border-left-color: rgb(19, 218, 19);"  class="alert alert-light">{{ Session::get('success') }} <button class="close" data-dismiss="alert">&times;</button></p>
@endif

@if (Session::has('error'))
<p style="border-left-color: rgb(19, 218, 19);"  class="alert alert-danger">{{ Session::get('error') }} <button class="close" data-dismiss="alert">&times;</button></p>
@endif

