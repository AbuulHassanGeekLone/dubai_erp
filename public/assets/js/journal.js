function editJournal(debit, credit) {
    // data = fp();
    const fp = document.querySelector("#date")._flatpickr;

    fp.setDate(debit.created_at);

    $("#collapseThree").attr("class", "collapse show");
    $("#description").val(debit.description);
    $("#amount").val(debit.amount);
    $("#credit_id").val(credit.id);
    $("#debit_id").val(debit.id);
    $("#debit")
        .val(
            debit.account_id +
                "," +
                debit.s_p_am_type +
                "," +
                debit.account_type_id
        )
        .change();
    $("#credit")
        .val(
            credit.account_id +
                "," +
                credit.s_p_am_type +
                "," +
                credit.account_type_id
        )
        .change();
    $("#journalform").prop("action", "/journal_update/" + debit.id);

    console.log(credit);
}

//journal delete
$("#dlt_journal").click(function() {
    var id = $("#delete_id").val();

    $.ajax({
        type: "GET",
        url: "/J_delete/" + id,
        success: function(data) {
            console.log(data);
            $(".tblrow_" + data).remove();
            $("#deleteModal .close").click();
        }
    });
});

//journal delete
$("#debit").change(function() {
    let type = $(this).val();
    let compare = type;
    if (type !== "") type = type.split(/[, ]+/).pop();

    let credits = [];
    if (type === "") {
        credits = false;
    } else if (["1", "11"].indexOf(type) !== -1) {
        credits = accountParents[0];
    } else {
        credits = accountParents[1];
    }

    let val = "";
    let options = '<option value="">Select Account</option>';

    if (credits !== false) {
        $.each(credits, function(index, value) {
            val = value.id + "," + value.type + "," + value.account_type;
            if (val == compare){
                options += `<option value="${val}" disabled>${value.account_name}</option>`;
            }else {
                options += `<option value="${val}">${value.account_name}</option>`;
            }
        });
    }

    $("#credit").html(options);
});
