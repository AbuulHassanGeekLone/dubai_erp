
//journal delete
$("#ledgerType").change(function() {
    let type = $(this).val();
    let options = '';
    let accountNamesList = [];
    if (type === "") {
        accountNamesList = false;
    } else if (["1"].indexOf(type) !== -1) {
        accountNamesList = accountNames[1];
        let val = "";
        let options = '<option value="">Select Account</option>';
        $.each(accountNamesList, function(index, value) {
            val = value.id + "," + 1 + "," + 0;
            options += `<option value="${val}">${value.name}</option>`;
        });
        $("#ledgerName").html(options);
    } else {
        accountNamesList = accountNames[2];
        let val = "";
        let options = '<option value="">Select Account</option>';
        $.each(accountNamesList, function(index, value) {
            val = value.id + "," + 2 + "," + 0;
            options += `<option value="${val}">${value.name}</option>`;
        });
        $("#ledgerName").html(options);

    }


});

