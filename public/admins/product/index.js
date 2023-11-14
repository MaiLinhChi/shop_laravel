function handleDelete (e) {
    e.preventDefault();
    const urlRequest = $(this).data('url');
    const parentElement = $(this);
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (data) {
                    if(data.code === 200) {
                        parentElement.parent().parent().remove();
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                },
                error: function () {

                }
            });
        }
      });
}

$(function() {
    $(document).on('click', '.action_delete', handleDelete);
})