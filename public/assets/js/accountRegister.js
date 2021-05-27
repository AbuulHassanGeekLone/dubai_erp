// $('#modelType').change(function(){
//
//     let val = $('#modelType').val();
//     console.log(val,typehistries);
// });
$("#modelType").change(function() {
    let model_id = $("#modelType").val();

    $("#model_name").html('<option value="">Loading... </option>');

    setTimeout(function() {
        let str = '<option value="">Select Name</option>';
        if (model_id == 1) {
            $.each(customers, function(i, v) {
                str += "<option value=" + v.id + ">" + v.name + "</option>";
            });
        }
        if (model_id == 2) {
            $.each(vendors, function(i, v) {
                str += "<option value=" + v.id + ">" + v.name + "</option>";
            });
        }
        if (model_id == 3) {
        } else {
        }

        $("#model_name").html(str);
    }, 800);

    console.log(model_id);
});
$("#accountTypeselect").change(function() {
    let acctype = $("#accountTypeselect").val();
    if (acctype == 1 || acctype == 3 || acctype == 10) {
        $("#opening_balanec").removeAttr("disabled", "true");
    } else $("#opening_balanec").attr("disabled", "true");
});
let acctype = $("#accountTypeselect").val();
if (acctype == 1 || acctype == 3 || acctype == 10) {
    $("#opening_balanec").removeAttr("disabled", "true");
} else $("#opening_balanec").attr("disabled", "true");
