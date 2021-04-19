(function ($) {
    $(document).ready(function () {

        //sweetalert wise delete
        $(document).on('click', '#delete', function (e) {
            var form = $(this).closest("form");
            e.preventDefault();


            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })

        });


    });
})(jQuery);
