//admin delete
$("#dlt_admin").click(function () {


    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/admindel/" + id,
        success: function (data) {
            $("#tblrow_" + id).remove();
            $("#deleteModal .close").click();
        },
    });
});

//operator delete
$("#dlt_operater").click(function () {


    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/operaterdel/" + id,
        success: function (data) {
            $("#tblrow_" + id).remove();
            $("#deleteModal .close").click();
        },
    });
});
