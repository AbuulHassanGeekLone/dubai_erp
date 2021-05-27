// $("#flash_message").delay(4500).slideToggle();

// $( "form" ).submit(function( event ) {
//     event.preventDefault();
//     console.log('not submited')
//
// });
// $('#b1').click(function () {
//     $("#accman").submit();
// });



$("#vendors").click(function () {});
$("#vendors").hover(
    function () {
        $("#vender2").removeAttr("hidden");
        $("#customer2").attr("hidden", true);
        $("#product2").attr("hidden", true);
        $("#sale2").attr("hidden", true);
        $("#purchase2").attr("hidden", true);
    },
    function () {}
);
$("#customer").hover(
    function () {
        $("#customer2").removeAttr("hidden");
        $("#vender2").attr("hidden", true);
        $("#product2").attr("hidden", true);
        $("#sale2").attr("hidden", true);
        $("#purchase2").attr("hidden", true);
    },
    function () {}
);

$("#purchase").hover(
    function () {
        $("#purchase2").removeAttr("hidden");
        $("#vender2").attr("hidden", true);
        $("#product2").attr("hidden", true);
        $("#sale2").attr("hidden", true);
        $("#customer2").attr("hidden", true);
    },
    function () {}
);

$("#sale").hover(
    function () {
        $("#sale2").removeAttr("hidden");
        $("#vender2").attr("hidden", true);
        $("#product2").attr("hidden", true);
        $("#purchase2").attr("hidden", true);
        $("#customer2").attr("hidden", true);
    },
    function () {}
);
$("#product").hover(
    function () {
        $("#product2").removeAttr("hidden");
        $("#vender2").attr("hidden", true);
        $("#sale2").attr("hidden", true);
        $("#purchase2").attr("hidden", true);
        $("#customer2").attr("hidden", true);
    },
    function () {}
);
$("#b1").click(function () {
    $('input[name="num"]').val(1);
});
$("#b2").click(function () {
    $('input[name="num"]').val(2);
});

//vendor delete
$("#dlt_vendor").click(function () {
    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/vendordel/" + id,
        success: function (data) {
            $("#tblrow_" + id).remove();
            $("#deleteModal .close").click();
        },
    });
});
//paybill


//account management delete
$("#dlt_vendor").click(function () {
    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/accountdelete/" + id,
        success: function (data) {
            $("#tblrow_" + id).remove();
            $("#deleteModal .close").click();
        },
    });
});

//customer delete
$("#dlt_customer").click(function () {
    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/customerdel/" + id,
        success: function (data) {
            $("#tblrow_" + id).remove();
            $("#deleteModal .close").click();
        },
    });
});
//product delete
$("#dlt_product").click(function () {
    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/productdel/" + id,
        success: function (data) {
            $("#tblrow_" + id).remove();
            $("#deleteModal .close").click();
        },
    });
});

//region delete
$("#dltregion").click(function () {
    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/regiondel/" + id,
        success: function (data) {
            $("#tblrow_" + id).remove();
            $("#deleteModal .close").click();
        },
    });
});

//region edit
$("#editregion").click(function () {
    var id = $("#delete_id").val();
    console.log(id);
});

//category edit
function editcategory(id, name) {
    $('input[name="name"]').val(name);
    $("#catadd").hide();
    $("#catupdate").removeAttr("hidden");
    $("#catform").prop("action", "/categoryupdate/" + id);
}
// category cencle
function cenclecategory() {
    $('input[name="name"]').val("");
}

//category delete
$("#dltcategory").click(function () {
    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/categorydel/" + id,
        success: function (data) {
            $("#tblrow_" + id).remove();
            $("#deleteModal .close").click();
        },
    });
});

//purchase delete
$("#dlt_purchase").click(function () {
    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/purchasedel/" + id,
        success: function (data) {
            $("#tblrow_" + id).remove();
            $("#deleteModal .close").click();
        },
    });
});


//sale delete
$("#dlt_sale").click(function () {
    console.log("add");

    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/saledel/" + id,
        success: function (data) {
            $("#tblrow_" + id).remove();
            $("#deleteModal .close").click();
        },
    });
});

//account type delete
$("#dltaccountType").click(function () {
    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/accounttypedelete/" + id,
        success: function (data) {
            $("#tblrow_" + id).remove();
            $("#deleteModal .close").click();
        },
    });
});

//editaccountType
function editaccountType(id,type, name) {
    $('input[name="name"]').val(name);
    $("#transection_type_id").val(type).change();
    $("#accountadd").hide();
    $("#accountupdate").removeAttr("hidden");
    $("#accountform").prop("action", "/accountypeupdate/" + id);
}

//category
function editRegion(id, name) {
    $('input[name="name"]').val(name);
    $("#regadd").hide();
    $("#regupdate").removeAttr("hidden");
    $("#regform").prop("action", "/regionupdate/" + id);
}
$( "#catval" ).keypress(function() {
    $("#categoryError").hide()
});

// add quick category
$("#Addcategory").click(function () {
    let newCategory = $("#catval").val();

    $.ajax({
        method: "GET",
        datatype: "JSON",
        url: "/category/create",
        data: {
            category: newCategory,
        },
        success: function (data, textStatus, jqXHR, dataType) {
            let str = "";
            $.each(data, function (i, v) {
                str += "<option value=" + v.id + ">" + v.name + "</option>";
            });
            $("#catselect").html(str);

            console.log("cat", newCategory);

            $("#catselect")
                .find("option")
                .each(function (index) {
                    if ($(this).text() === newCategory) {
                        // let category = $("#catselect").val();
                        $("#catselect").val($(this).val());
                    }
                    // console.log($(this).text());
                });

            $("#catval").val("");
            $("#exampleModal").modal("toggle");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            let statusCode = jqXHR.status;

            if (statusCode == 400) {
                let code = jqXHR.responseJSON.code;
                let message = jqXHR.responseJSON.message;

                if(code == 1062) $("#categoryError").show();
            }
        },
    });
});

// add quick account type
$("#AddAccountType").click(function () {
    let newaccountType = $("#accountType").val();

    $.ajax({
        method: "GET",
        datatype: "JSON",
        url: "/accountType/create",
        data: {
            accountType: newaccountType,
        },
        success: function (data, textStatus, jqXHR, dataType) {
            let str = "";
            $.each(data, function (i, v) {
                str += "<option value=" + v.id + ">" + v.name + "</option>";
            });
            $("#accountTypeselect").html(str);
            $("#accountTypeselect")
                .find("option")
                .each(function (index) {
                    if ($(this).text() === newaccountType) {
                        // let category = $("#catselect").val();
                        $("#accountTypeselect").val($(this).val());
                    }
                    // console.log($(this).text());
                });

            $("#accountType").val("");
            $("#exampleModal").modal("toggle");
        },
        error: function (jqXHR, textStatus, errorThrown) {},
    });
});

$( "#regval" ).keypress(function() {
    $("#region_error").hide()
});

// add quick region
$("#Addregion").click(function () {
    let region_val = $("#regval").val();
    //Convert Region first letter to capital Agile data 2020
    let val = capitalizeFirstLetter(region_val);
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    $.ajax({
        method: "GET",
        datatype: "JSON",
        url: "/region/create",
        data: {
            region: val,
        },
        success: function (data, textStatus, jqXHR, dataType)
        {
            regionCities[data.id] = [];
           let str = "<option value=" + data.id + ">" + data.name + "</option>";
            $("#vendor_reg").append(str);
            $("#vendor_reg").val(data.id);
            $("#regval").val("");
            $("#exampleModal").modal("toggle");

        },
        error: function (jqXHR) {
            let statusCode = jqXHR.status;

            if (statusCode == 400) {
                let code = jqXHR.responseJSON.code;
                let message = jqXHR.responseJSON.message;

                if(code == 1062) $("#region_error").show()
            }
        },
    });
});

// =============== add quick City ====== agiledata 2020
$("#addcity" ).keypress(function() {
    $("#city_error").hide();
    $("#city_error1").hide();
});
$("#Addcity").click(function () {
    let region_id = $("#vendor_reg").val();
    let name_city = $("#addcity").val();
    //Convert City first letter to capital agilrdata2020
    let name = capitalizeFirstLetter(name_city);
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }


    $.ajax({
        method: "POST",
        datatype: "JSON",
        url: "/ajax_citycreate",
        data: {
            region_id: region_id,
            name: name,
        },
        success: function (data, textStatus, jqXHR, dataType)
        {

            regionCities[data.region_id].push(data);
           let str = "<option value=" + data.id + ">" + data.name + "</option>";
            $("#city_select").append(str);

            $("#city_select").val(data.id);

            $("#addcity").val("");
            $("#exampleModalcity").modal("toggle");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            let statusCode = jqXHR.status;
            if (statusCode == 400) {
                let code = jqXHR.responseJSON.code;
                let message = jqXHR.responseJSON.message;

                if(code == 1062) $("#city_error").show();
                if(code == 1062) $("#city_error1").show();
            } else {

                $("#city_error1").show();
            }
        },
    });
});
