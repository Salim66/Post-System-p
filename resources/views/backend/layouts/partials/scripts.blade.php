<!-- jQuery -->

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/assets/plugins/') }}/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/assets/plugins/') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('backend/assets/plugins/') }}/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('backend/assets/plugins/') }}/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('backend/assets/plugins/') }}/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('backend/assets/plugins/') }}/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend/assets/plugins/') }}/moment/moment.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/assets/plugins/') }}/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
</script>
<!-- Summernote -->
<script src="{{ asset('backend/assets/plugins/') }}/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/assets/plugins/') }}/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/assets/dist/') }}/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/assets/dist/') }}/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('backend/assets/dist/') }}/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('backend/assets/plugins/') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/jszip/jszip.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('backend/assets/plugins/') }}/select2/js/select2.full.min.js"></script>
<!-- jquery-validation -->
<script src="{{ asset('backend/assets/plugins/') }}/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/jquery-validation/additional-methods.min.js"></script>

<!-- Custom Js -->
<script src="{{ asset('backend/assets/dist/') }}/js/custom/custom.js"></script>
<!-- SweetAlert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(function(){
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
</script>

<!-- Page specific script -->
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": []
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    $(function () {
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                },
                userType: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password2: {
                    required: true,
                    equalTo: '#password'
                },
                //change password
                current_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    equalTo: '#new_password'
                },
            },
            messages: {
                name: {
                    required: "Please enter a name",
                },
                userType: {
                    required: "Please enter a user role",
                },
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a vaild email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                password2: {
                    required: "Please provide a password",
                    equalTo: "Confirm password do not match!"
                },

                //password change user
                current_password: {
                    required: "Please enter your current password",
                },
                new_password: {
                    required: "Please enter new password",
                    minlength: "Your password must be at least 6 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    equalTo: "Confirm password do not match!"
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

        $(function(){
            $(document).on('click', '#user_delete', function(e){
                e.preventDefault();
                const link = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be delete this user!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                     })
            });
        });
    });
</script>

{{-- User Image --}}
<script>
    (function($){
          $(document).ready(function(){
            $(document).on('change', '#user_image', function(e){
                e.preventDefault();
                let image_url = URL.createObjectURL(e.target.files[0]);
                $('#image_src').attr('src', image_url);
            });
          });
      })(jQuery)
</script>

<!-- Notify Js -->
@if(Session::has('success'))
<script>
    $(function(){
        $.notify("{{ Session::get('success') }}", {globalPosition:'top right', className:'success'});
    });
</script>
@endif
@if(Session::has('error'))
<script>
    $(function(){
        $.notify("{{ Session::get('error') }}", {globalPosition:'top right', className:'error'});
    });
</script>
@endif
@if(Session::has('warning'))
<script>
    $(function(){
        $.notify("{{ Session::get('warning') }}", {globalPosition:'top right', className:'warning'});
    });
</script>
@endif