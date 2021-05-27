////////////////////////////start mandi purchase///////////////////
$('input.for_total_change').each(function () {
    $(this).change(function () {
        $wt_of_bag = $("#weight_of_one_bag").val();
        $qty_of_total_bags = $("#total_bag").val();
        $rate = $("#price").val();
        $total_weight = $wt_of_bag * $qty_of_total_bags;
        $total_amount = ($rate/40) * $total_weight;
        $("#total_weight").val($total_weight);
        $("#total_amt").val($total_amount)
    });
});

$("#submit_mandi_purcahse").click(function() {

    let data = {};
    data.name = $("#customer_id").val();
    data.item_name = $("#item_id").val();
    data.wt_of_bag = $("#weight_of_one_bag").val();
    data.qty_of_total_bags = $("#total_bag").val();
    data.rate = $("#price").val();

    data.bag_price = $("#bag_price").val();
    data.market_fee = $("#market_fee_of_bag").val();
    data.stitching_bag = $("#stitching_of_bag").val();
    data.loading_bag = $("#loading_of_bag").val();
    data.filling_bag = $("#filling_of_bag").val();
     // $("#total_weight").val();
     // $("#total_amount").val();

    if (data.name == "") {
        alert("Enter name");
        return false;
    }

    if (data.phone == "") {
        alert("Enter phone");
        return false;
    }
    if (data.item_name == "") {
        alert("Enter Item Name");
        return false;
    }
    if (data.wt_of_bag == "" && data.wt_of_bag <= 1) {
        alert("Wight Of Bag must be greater then 0");
        return false;
    }
    if (data.qty_of_total_bags == "" && data.qty_of_total_bags <= 1) {
        alert("Quantity must be Greater then 0");
        return false;
    }

    if (data.rate == "" && data.rate <= 1) {
        alert("Price/Rate must be positive number or Greater then 0");
        return false;
    }
    if (data.filling_bag == "" && data.filling_bag <= 1) {
        alert(" Filling must be positive number or Greater then 0");
        return false;
    }
    if (data.loading_bag == "" && data.loading_bag <= 1) {
        alert("Loading must be positive number or Greater then 0");
        return false;
    }
    if (data.stitching_bag == "" && data.stitching_bag <= 1) {
        alert("Stitching must be positive number or Greater then 0");
        return false;
    }
    if (data.market_fee == "" && data.market_fee <= 1) {
        alert("Market Fee must be positive number or Greater then 0");
        return false;
    }
    if (data.bag_price == "" && data.bag_price <= 1) {
        alert("Bag Price must be positive number or Greater then 0");
        return false;
    }


});

$("#save_customer").click(function() {

    let data = {};
    data.name = $("#customer_name").val();
    data.phone = $("#customer_phone").val();
    data.address = $("#customer_address").val();

    if (data.name == "") {
        alert("Enter name");
        return false;
    }
    if (data.phone == "") {
        alert("Enter phone");
        return false;
    }
    if (data.address == "") {
        alert("Enter Address");
        return false;
    }

});


$("#save_item").click(function() {

    let data = {};
    data.name = $("#item_name").val();

    if (data.name == "") {
        alert("Enter Item name");
        return false;
    }

});
$("#shortcut_customer_add").click(function(event){
    event.preventDefault();
    let name = $("#customer_name_short").val();
    let phone = $("#customer_phone_short").val();
    let address = $("#customer_address_short").val();
    $.ajax({
        url: "/customer_store",
        type:"POST",
        data: {
            customer_name:name,
            customer_phone:phone,
            customer_address:address,
        },
        success:function(data){
            console.log(data.data);
            console.log("data success");
            $("#add_customer_model .close").click();

        },
    });
});

$("#shortcut_item_add").click(function(event){
    event.preventDefault();
    let name = $("#item_name_short").val();
    console.log("item_store");
    $.ajax({
        url: "/item_store",
        type:"POST",
        data: {
            item_name:name,
        },
        success:function(data){
            console.log(data.data);
            console.log("data success");
            $("#add_item_model .close").click();

        },
    });
});

////////////////////////////end mandi purchase////////////////////

//getpsprice for product using product dropdown
function getpsPrice(product) {

    let $prod = $(product);
    let qty = $prod.find("option:selected").data("qty");
    let pprice_to = Number($prod.find("option:selected").data("pprice"));
    let pprice = pprice_to.toFixed(2);

    let sprice_to = Number($prod.find("option:selected").data("sprice"));
    let sprice = sprice_to.toFixed(2);
    if (pprice === "" || sprice === "" || pprice === "0.00" || sprice === "0.00") {

        $('input[name="u_price"]').val("");
        $('input[name="s_price"]').val("");
    } else {
        $('input[name="u_price"]').val(pprice);
        $('input[name="s_price"]').val(sprice);
        $('input[name="pquantity"]').val(1);
        $('input[name="discount"]').val(0);

    }
    // For Show Quantity of Purchase Goods
    if ($("#product").val() === "")
    {
        $("#qa").html("");
    }
    else {


        $("#qa").html("{<b> " + qty + " </b>}");
        $("#quantity").prop("max", qty);


    }
}

// add product into purchase table

$("#addproduct").click(function() {
    let data = {};
    data.v_id = $("#vendor").val();
    data.p_id = $("#product").val();

    data.p_name = $("#product :selected").text();
    data.p_quantity = $("#pquantity").val();
    data.p_price = $("#u_price").val();
    data.s_price = $("#s_price").val();
    data.discount = $("#discount").val();

    if (data.v_id == "") {
        alert("Enter Vendor");
        return false;
    }
    if (data.p_id == "") {
        alert("Enter Product");
        return false;
    }
    if (data.p_quantity == "" || data.p_quantity < 1) {
        alert("Quantity must be positive number Greater then 0");
        return false;
    }

    if (data.p_price == "" || data.p_price < 1 ) {
        alert("Unit Price must be positive number Greater then 0");
        return false;
    }
    if (data.s_price == "" || data.s_price < 1) {
        alert("Sale Price must be positive number Greater then 0");
        return false;
    }
    if (data.discount == "" || data.discount < 1) {
        data.discount = 0;
    }

    var subtotal = Number(data.p_price) * Number(data.p_quantity);
    discountc = subtotal / 100;
    discountc = discountc * Number(data.discount);
    subtotal = subtotal - discountc;
    subtotal = subtotal.toFixed(1);

    let row_num = $("#mytable tbody tr").length;

    let htmlRow = `
        <tr>
            <td>
                <input type="hidden" name="po[${row_num}][v_id]" value="${data.v_id}" />
                <input type="hidden" name="po[${row_num}][p_id]" value="${data.p_id}" />

                <input type="hidden" name="po[${row_num}][p_name]" value="${data.p_name}" />
                ${data.p_name}
            </td>
            <td>
                <input style="display: none" type="number" class="pqty_hidden form-control" name="po[${row_num}][p_quantity]" value="${data.p_quantity}" />
                <span class="pqty_text">${data.p_quantity}</span>
            </td>
            <td >
                <input style="display: none" type="number" class="pprice_hidden form-control" name="po[${row_num}][p_price]" value="${data.p_price}" />
                <span class="pprice_text">${data.p_price}</span>
            </td>
            <td>
                <input style="display: none" type="number" class="psale_hidden form-control" name="po[${row_num}][s_price]" value="${data.s_price}" />

                <span class="psale_text">${data.s_price}</span>
            </td>
            <td>
                <input style="display: none" type="number" class="pdiscount_hidden form-control" name="po[${row_num}][discount]" value="${data.discount}" />

                <span class="pdiscount_text">${data.discount}</span>
            </td>
            <td> <span class="psubtotal_text">${subtotal}</span></td>
            <td  style="min-width: 130px;">
             <button type="button" onclick="editprow(this)"
                              class="btn btn-info cutm_btn btn-sm">
                          <i class="fa fa-edit"></i>
                      </button>
                  <button style="display:none" type="button" onclick="updateprow(this)"
                              class="btn btn-secondary btn-sm">
                          <i class="fa fa-check"></i>
                      </button>
                  <button type="button"
                          data-prod_id="${data.p_id}"
                          class="btn btn-danger rmv btn-sm">
                          <i class="fa fa-trash"></i>
                      </button>
            </td>
        </tr>
    `;

    $("#mytable tbody").append(htmlRow);
    $("#savebtn").removeAttr("hidden");
    $("#updatebtn").removeAttr("hidden");
    $("#hideprintPaybill").toggle();

    $("#product :selected").prop("disabled", true);
    $("#u_price").val("");
    $("#s_price").val("");
    $("#discount").val("0");
    $("#pquantity").val("1");
    $("#vendor").prop("disabled", "disabled");
    $("#product")
        .val("")
        .change();
    var table = $("table tbody");
    var t_quantity = 0;
    var f_total = 0;
    var count = 0;
    table.find("tr").each(function(i) {
        count++;
        var $tds = $(this).find("td"),
            Quantity = $tds.eq(1).text(),
            subtotal = $tds.eq(5).text();
        // do something with productId, product, Quantity
        (t_quantity = t_quantity + Number(Quantity)),
            (f_total = f_total + Number(subtotal));
    });
    $("#f_total").html(" " + f_total);
    $("#t_quantity").html(t_quantity);
    $("#t_items").html(count);
    $('input[name="total_amount"]').val(f_total);
    $('input[name="t_amount"]').val(f_total);

    // $("#product :selected").prop("disabled", true);
});



// edit purchase row
function editprow(btn) {
    $tr = $(btn).closest("tr");

    $tr.find(".pqty_text").toggle();
    $tr.find(".pqty_hidden").toggle();
    $tr.find(".pdiscount_hidden").toggle();
    $tr.find(".pdiscount_text").toggle();
    $tr.find(".pprice_hidden").toggle();
    $tr.find(".pprice_text").toggle();
    $tr.find(".psale_hidden").toggle();
    $tr.find(".psale_text").toggle();
    $tr.find(".btn-info").toggle();
    $tr.find(".btn-danger").toggle();
    $tr.find(".btn-secondary").toggle();
    $('#paybill').hide();
    $('#print').hide();

    $("#updatebtn").attr("hidden", true);

    // $(".qty_hidden").toggle();
    // $(".qty_text").toggle();
}

// update purchase row
function updateprow(btn) {
    $tr = $(btn).closest("tr");

    //ge values
    let newqty = $tr.find(".pqty_hidden").val();
    let newdiscount = $tr.find(".pdiscount_hidden").val();
    let pprice = $tr.find(".pprice_hidden").val();
    let psale = $tr.find(".psale_hidden").val();

    // calculate sub total
    let netdiscount = Number(pprice) * Number(newdiscount);
    netdiscount = netdiscount / 100;
    let net_price = Number(pprice) - Number(netdiscount);
    var subtotal = net_price * Number(newqty);
    subtotal = subtotal.toFixed(1);
    console.log(subtotal);
    //assign values
    let $pqty_hidden = $tr.find(".pqty_hidden");
    $pqty_hidden.attr("value", newqty);
    $pqty_hidden.siblings(".pqty_text").text(newqty);

    let $pdiscount_hidden = $tr.find(".pdiscount_hidden");
    $pdiscount_hidden.attr("value", newdiscount);
    $pdiscount_hidden.siblings(".pdiscount_text").text(newdiscount);

    let $pprice_hidden = $tr.find(".pprice_hidden");
    $pprice_hidden.attr("value", pprice);
    $pprice_hidden.siblings(".pprice_text").text(pprice);

    $psale_hidden = $tr.find(".psale_hidden");
    $psale_hidden.attr("value", psale);
    $psale_hidden.siblings(".psale_text").text(psale);

    $tr.find(".psubtotal_text").text(subtotal);

    // re calculate grand total
    var table = $("table tbody");
    var t_quantity = 0;
    var f_total = 0;
    var count = 0;
    table.find("tr").each(function(i) {
        count++;
        var $tds = $(this).find("td"),
            Quantity = $tds.eq(1).text(),
            subtotal = $tds.eq(5).text();
        // do something with productId, product, Quantity
        (t_quantity = t_quantity + Number(Quantity)),
            (f_total = f_total + Number(subtotal));
    });
    $("#f_total").html(" " + f_total);
    $("#t_quantity").html(t_quantity);
    $("#t_items").html(count);
    $('input[name="total_amount"]').val(f_total);
    $('input[name="t_amount"]').val(f_total);
    $('input[name="total_samount"]').val(f_total);

    $tr.find(".pqty_text").toggle();
    $tr.find(".pqty_hidden").toggle();
    $tr.find(".pdiscount_hidden").toggle();
    $tr.find(".pdiscount_text").toggle();
    $tr.find(".pprice_text").toggle();
    $tr.find(".pprice_hidden").toggle();
    $tr.find(".psale_text").toggle();
    $tr.find(".psale_hidden").toggle();
    $tr.find(".btn-info").toggle();
    $tr.find(".btn-danger").toggle();
    $tr.find(".btn-secondary").toggle();


    $("#updatebtn").removeAttr("hidden");
}

