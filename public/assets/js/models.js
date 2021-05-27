
//models

$('#exampleModalcity').on('shown.bs.modal', function () {
    $('#addcity').focus();
});
$('#exampleModal').on('shown.bs.modal', function () {
    $('#regval').focus();
});
$('#exampleModal').on('hidden.bs.modal', function (e) {
    $('#regval').val("");
    $("#region_error").hide();

});
$('#exampleModalcity').on('hidden.bs.modal', function (e) {
    $('#addcity').val("");
    $("#city_error").hide();
    $("#city_error1").hide();
});
$('#exampleModal').on('shown.bs.modal', function () {
    $('#catval').focus();
});
$('#exampleModal').on('hidden.bs.modal', function (e) {
    $('#catval').val("");
    $("#categoryError").hide();

});

