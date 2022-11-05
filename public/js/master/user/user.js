
$(function () {
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });

    console.log("asd");
    console.log($("input[name=search]").val());

    var btnBackURL = $("#table_reporting").data("backurl");
    var btnBackURLHome = $("#dataForm").data("backurl");
    var url = $("#table_reporting").data("url");
    var table = $("#table_reporting").DataTable({
      // paging: false,
      // ordering: false,
      // info: false,
      processing: true,
      serverSide: true,
      bFilter: false,
      language: {
        sEmptyTable: "Tidak ada data yang tersedia pada tabel ini",
        sProcessing: "Sedang memproses...",
        sLengthMenu: "Tampilkan data _MENU_",
        sZeroRecords: "Tidak ditemukan data yang sesuai",
        sInfo: "_START_ - _END_ dari _TOTAL_",
        sInfoEmpty: "0 - 0 dari 0",
        sInfoFiltered: "(disaring dari _MAX_ data keseluruhan)",
        sInfoPostFix: "",
        sSearch: "",
        searchPlaceholder: "Cari",
        sUrl: "",
        oPaginate: {
          sFirst: "pertama",
          sPrevious: "sebelumnya",
          sNext: "selanjutnya",
          sLast: "terakhir",
        },
      },
      ajax: {
        url: url,
        data: function (d) {
          d.search = $("input[name=search]").val();
          console.log(d.search);
        //   d.status_select = $("select#status_select option:checked").val();
        //   d.range_date = $("input[name=range_date]").val();
        },
      },
      columns: [
        {
          data: "DT_RowIndex",
          name: "DT_RowIndex",
          orderable: false,
          searchable: false,
        },
      
        {
            data: "username",
            name: "username",
          },
        {
          data: "namadepan",
          name: "namadepan",
        },
        {
            data: "namabelakang",
            name: "namabelakang",
        },
      
        {
            data: "jabatan",
            name: "jabatan",
        },
        {
            data: "nip",
            name: "nip",
        },
        {
            data: "get_access.get_role.name",
            name: "get_access.get_role.name",
          },
       
        {
            data: "dephead",
            name: "dephead",
        },
        {
            data: "teamlead",
            name: "teamlead",
        },

       
          {
            data: "action",
            name: "action",
            orderable: false,
            searchable: false,
            className: "text-center",
          },
      ],
    });
  $('#table_reporting').on('click', '.booton[data-id]', function (e) { 
    console.log("asdsad")
    var id    = $(this).data("id");
    console.log(id)

    e.preventDefault();
    var token = $("meta[name='csrf-token']").attr("content");
    var warningMessage = "";
    var buttonName = "Delete";

    Swal.fire({

        title: "Apakah ingin Delete Data !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: buttonName,
    }

    ).then(function (result) {
        if (result.value) {
            console.log(result);
            // loadingScreen('Dalam Proses ...');
            $.ajax({
                url: '/user/status',
                type: 'POST',
                data: {
                    id: id,
                    _token: token,
                },

                success: function (response) {
                    if (response.status == 200) {
                      console.log(response)

                        $.unblockUI();
                        Swal.fire({
                            icon: "success",
                            title: response.header,
                            text: response.message,
                            // confirmButtonClass: 'btn btn-success',
                        }).then(function (result) {
                            if (result.value) {
                                table.draw();
                            }
                        });
                        if (response.header == "Success") {
                       
                        }
                    } else {
                        $.unblockUI();
                        Swal.fire({
                            icon: "warning",
                            title: response.header,
                            // text: response.message,
                            confirmButtonClass: 'btn btn-success',
                        }).then(function (result) {
                            if (result.value) {
                                table.draw();
                               
                            }
                        });
                    }
                }
            });
        } else {
            table.draw();
        }
    });
  })

    // Search Form
    $("#search_form").on("submit", function (e) {
      e.preventDefault();
      loadingScreen("Mohon Tunggu ...");
      table.draw();
      // console.log("status : ", $("select#status_select option:checked").val());
    });

    $("#ajaxModel").on("hidden.bs.modal", function (e) {
      $("#count").val(0).trigger("change");
      $("#kode_perkiraan_select").val(0).trigger("change"); // $(".anak").hide();
      $(".anak").remove();
    });

});

// Reset Form
$("#reset_form").on("click", function (e) {
    e.preventDefault();
    $("#search_form").trigger("reset");
    // $("#status_select").val(null).trigger("change");
    $.blockUI({
      message:
        '<img src="' +
        src +
        '" style="height: 80px; width: auto"> <hr> <h3>Mohon Tunggu ...</h3>',
      timeout: 500, //unblock after 0.5 seconds
      overlayCSS: {
        backgroundColor: $white,
        opacity: 0.8,
        cursor: "wait",
      },
      css: {
        border: 0,
        padding: 0,
        backgroundColor: "transparent",
      },
    });
    loadingScreen("Mohon Tunggu ...");
    table.draw();
  });





function loadingScreen(msg) {
    var $white = '#fff';
    var src = $("#logo_kai").attr('src');
    $.blockUI({
        message: '<img src="' + src + '" style="height: 80px; width: auto"> <hr> <h3>' + msg + '</h3>',
        timeout: 5000, //unblock after 5 seconds
        overlayCSS: {
            backgroundColor: $white,
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'transparent'
        }
    });
}
