function editCity(id, name , region_name , region_id) {

    $('input[name="name"]').val(name);
    $('input[name="region_id"]').val(region_name).change();
    $("#region_id").val(region_name).change();
    $("#cityadd").hide();
    $("#cityupdate").removeAttr("hidden");
    $("#cityform").prop("action", "/cityupdate/" + id);
}


$("#dltcity").click(function () {
    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/citydel/" + id,
        success: function (data) {
            $("#tblrow_" + id).remove();
            $("#deleteModal .close").click();
        },
    });
});

// show city against region
$("#vendor_reg").change(function () {

    let region_id = $("#vendor_reg").val();

    let cities = regionCities[region_id];

    $("#city_select").html('<option value="">Loading... </option>');
    setTimeout(function(){
        let str = '<option value="">Select City</option>';
        $.each(cities, function (i, v) {
            str += "<option value=" + v.id + ">" + v.name + "</option>";
        });

        $("#city_select").html(str);
    }, 800);
});
$(".select2").select2({
    containerCssClass: function(e) {
        return $(e).attr('required') ? 'required' : '';
    }
});
