/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

// swal btn hps data
const deleteData = (id, tabel) => {
    console.log(id, tabel);
    let token = $("meta[name='csrf-token']").attr("content");

    swal({
        title: "Apakah anda yakin?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                type: "POST",
                url: `/dashboard/${tabel}/hapus/${id}`,
                success: function (response) {
                    console.log(response);
                    if (response) {
                        swal("Terhapus", "Data telah dihapus", "success").then(
                            () => {
                                location.reload();
                            }
                        );
                    } else {
                        swal("Error", "Failed to delete data.", "error");
                    }
                },
                error: function (error) {
                    console.error("AJAX Error:", error);
                    swal("Error", "Ajax Error.", "error");
                },
            });
        }
    });
};
