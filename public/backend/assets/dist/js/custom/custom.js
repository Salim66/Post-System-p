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

        //sweetalert wise purchase approved
        $(document).on('click', '#approved', function (e) {
            e.preventDefault();
            let link = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to approved this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approved it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    Swal.fire(
                        'Approved!',
                        'Your file has been approved.',
                        'success'
                    )
                }
            })

        });


    });
})(jQuery);
