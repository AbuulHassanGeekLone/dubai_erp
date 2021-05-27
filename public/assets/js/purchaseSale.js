$(function()
{
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
    $("#t_quantity").html(t_quantity.toFixed(2));
    $("#t_items").html(count);
    $('input[name="total_amount"]').val(f_total.toFixed(2));
    $('input[name="t_amount"]').val(f_total.toFixed(2));
    $('input[name="total_samount"]').val(f_total.toFixed(2));
    let paid = $('#p_paid').val();
    let balance1 =  f_total - paid;
    $("#balance").html(" " + balance1.toFixed(2) );

    $("#quantity").change(function() {
        var qa = $("#quantity").prop("max");
        quantity = $("#quantity").val();
        if (Number(qa) < Number(quantity)) {
            $("#quantity").val(qa);
            alert("Maximun Quantity Selected is " + qa);
        }
        if (Number(quantity) <= 0.9999999) {
            $("#quantity").val(1);
            alert("Minimun Quantity Selected is 1");
        }
    });
});


// sale and purchse  Pay Bill button action
function paybill() {
    var table = $("table tbody");
    var f_total = 0;
    var count = 0;
    table.find("tr").each(function(i) {
        count++;
        var $tds = $(this).find("td"),
            subtotal = $tds.eq(5).text();
        // do something with productId, product, Quantity
        (f_total = f_total + Number(subtotal));
    });
    $("#f_total").html(" " + f_total);
    let paid = $('#p_paid').val();
    let blns =  f_total - paid ;

    let credit = Number($('#method').find("option:selected").data('dc'));
    if ( credit > blns){
        $('input[name="amount_paid"]').val(blns.toFixed(2));
    }else {
        $('input[name="amount_paid"]').val(credit.toFixed(2));
    }


}

//getprice for sale
function getPrice(product) {
    let $prod = $(product);
    let price = Number($prod.find("option:selected").data("price"));
    price = price.toFixed(2);
    // let  price  =  Number(separate_price.toFixed(2));
    let qty = $prod.find("option:selected").data("qty");
    let sold = $prod.find("option:selected").data("sold");

    if ($("#product").val() === "")
    {
        $("#qa").html("");
    }
    else {
           if (sold == "")
          {
            $("#qa").html("{<b> " + qty + " </b>}");
            $("#quantity").prop("max", qty);
          }
           else
            {
            let qtyAvailable = Number(qty) - Number(sold);
            $("#qa").html("{<b> " + qtyAvailable + " </b>}");
            $("#quantity").prop("max", qtyAvailable);
               }
      }

    $('input[name="u_price"]').val(price);
    $("#quantity").val(1);
    $("#discount").val(0);
    // $prod.find("option:selected").prop("disabled", true);
}

//add Sale

$("#addsproduct").click(function() {
    let data = {};
    data.customer_id = $("#customer").val();
    data.product_id = $("#product").val();
    data.product_name = $("#product :selected").text();
    data.quantity = $("#quantity").val();
    data.unit_price = $("#u_price").val();
    data.discount = $("#discount").val();
    netdiscount = Number(data.unit_price) * Number(data.discount);
    netdiscount =  netdiscount.toFixed(2);
    netdiscount = netdiscount / 100;
    data.net_price = Number(data.unit_price) - Number(netdiscount);

    if (data.customer_id == "") {
        alert("Enter customer");
        return false;
    }
    if (data.product_id == "") {
        alert("Enter Product");
        return false;
    }
    if (data.quantity == "") {
        alert("Enter quantity");
        return false;
    }
    if (qa < data.p_quantity || data.p_quantity < 1) {
        alert("Enter amount equal to or less then  " + qa);
    }
    if (data.unit_price == "" || data.unit_price < 1) {
        alert("Unit Price must be positive number Greater then 0");
        return false;
    }
    if (data.discount == "" || data.discount < 1) {
        data.discount = 0;
    }

    var subtotal = data.net_price * Number(data.quantity);
    subtotal = subtotal.toFixed(2);

    let row_num = $("#mytable tbody tr").length;

    let htmlRow = `
        <tr>
            <td>
                <input type="hidden" name="po[${row_num}][customer_id]" value="${data.customer_id}" />
                <input type="hidden" name="po[${row_num}][product_id]" value="${data.product_id}"  />

                <input type="hidden" name="po[${row_num}][product_name]" value="${data.product_name}" />
                ${data.product_name}
            </td>

            <td>
                <input style="display: none" type="number" class="qty_hidden form-control" name="po[${row_num}][quantity]" value="${data.quantity}" />
                <span class="qty_text">${data.quantity}</span>
            </td>
            <td>
                <input type="hidden" name="po[${row_num}][unit_price]" value="${data.unit_price}" />
                <span class="price_text">${data.unit_price}</span>
            </td>
            <td>
                <input style="display: none" type="number" class="discount_hidden form-control" name="po[${row_num}][discount]" value="${data.discount}" />
                <span class="discount_text">${data.discount}</span>
            </td>
            <td>
                <input style="display: none" type="number" class="netprice_hidden form-control" name="po[${row_num}][net_price]" value="${data.net_price}" />
                <span class="netprice_text">${data.net_price}</span>
            </td>
            <td>
            <span class="subtotal_text"> ${subtotal}</span>
           </td>
            <td  style="min-width: 130px;">
                 <button type="button" onclick="editrow(this)"
                              class="btn btn-info cutm_btn btn-sm">
                          <i class="fa fa-edit"></i>
                      </button>
                  <button style="display:none" type="button" onclick="updaterow(this)"
                              class="btn btn-secondary btn-sm">
                          <i class="fa fa-check"></i>
                      </button>
                  <button type="button"
                                data-prod_id="${data.product_id}"
                                class="btn btn-danger rmv btn-sm">
                          <i class="fa fa-trash"></i>
                      </button>
            </td>
        </tr>
    `;

    $("#mytable tbody").append(htmlRow);
    $("#savesale").removeAttr("hidden");
    $("#updatebtn").removeAttr("hidden");
    $("#hideprintPaybill").hide();


    $("#product :selected").prop("disabled", true);
    $("#u_price").val("");
    $("#s_price").val("");
    $("#discount").val("0");
    $("#quantity").val("1");
    $("#customer").prop("disabled", "disabled");
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
    $("#f_total").html(" " + f_total.toFixed(2));
    $("#t_quantity").html(t_quantity);
    $("#t_items").html(count);

    $('input[name="t_amount"]').val(f_total.toFixed(2));
    $('input[name="total_samount"]').val(f_total.toFixed(2));
});

$(function() {
    $("#mytable").on("click", ".rmv", function() {
        let prod_val = $(this).data('prod_id');

        $("#product option[value="+prod_val+"]").prop('disabled', false);

        $(this)
            .parents("tr")
            .remove();
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
        $("#f_total").html(" " + f_total.toFixed(2));
        $("#t_quantity").html(t_quantity);
        $("#t_items").html(count);

        if(t_quantity === 0){
            $("#savebtn").attr("hidden", true);
            $("#updatebtn").attr("hidden", true);
            $("#savesale").attr("hidden", true);
            $("#updatebtn").attr("hidden", true);
            $("#print").attr("hidden", true);
            $("#paybill").attr("hidden", true);
        } else {
            $("#savebtn").removeAttr("hidden", true);
            $("#updatebtn").removeAttr("hidden", true);
            $("#savesale").removeAttr("hidden", true);
            $("#updatebtn").removeAttr("hidden", true);
            $("#print").attr("hidden", true);
            $("#paybill").attr("hidden", true);
        }

        $('input[name="t_amount"]').val(f_total.toFixed(2));
        $('input[name="total_samount"]').val(f_total.toFixed(2));
    });
});
flatpickr(".datepicker", {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d"
});

// onclick="handleEdit(this)"
function handleEdit(td) {
    $td = $(td);
    $td.children(".qty_hidden").toggle();
    $td.children(".qty_text").toggle();


}

// $(".qty_hidden").change(function() {
// })

// $("#example").on("change", ".qty_hidden", function() {
//     $(this)
//         .siblings(".qty_text")
//         .text(this.value);
// });

// edit sale row
function editrow(btn) {
    $tr = $(btn).closest("tr");

    $tr.find(".qty_text").toggle();
    $tr.find(".qty_hidden").toggle();
    $tr.find(".discount_hidden").toggle();
    $tr.find(".discount_text").toggle();
    $tr.find(".btn-info").toggle();
    $tr.find(".btn-danger").toggle();
    $tr.find(".btn-secondary").toggle();
    $('#paybill').hide();
    $('#print').hide();

    $("#updatebtn").attr("hidden", true);
}

// update sale row
function updaterow(btn) {
    //ge values
    var qa = $("#quantity").prop("max");
    let quantity = $tr.find(".qty_hidden").val();
    if (Number(qa) < Number(quantity)) {
        $tr.find(".qty_hidden").val(qa);
        alert("Maximun Quantity available for Selection is " + qa);
    }
    if (Number(quantity) <= 0.9999999) {
        $tr.find(".qty_hidden").val(1);
        alert("Minimun Quantity Selected is 1");
    } else {
        $tr = $(btn).closest("tr");
        let newqty = $tr.find(".qty_hidden").val();
        let newdiscount = $tr.find(".discount_hidden").val();
        let price = $tr.find(".price_text").text();

        // calculate sub total
        let netdiscount = Number(price) * Number(newdiscount);
        netdiscount = netdiscount / 100;
        let net_price = Number(price) - Number(netdiscount);
        var subtotal = net_price * Number(newqty);
        subtotal = subtotal.toFixed(1);


        //assign values
        $tr.find(".qty_hidden").attr("value", newqty);
        $tr.find(".discount_hidden").attr("value", newdiscount);
        $tr.find(".netprice_hidden").attr("value", net_price);
        $tr.find(".qty_text").text(newqty);
        $tr.find(".discount_text").text(newdiscount);
        $tr.find(".netprice_text").text(net_price);
        $tr.find(".subtotal_text").text(subtotal);

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
        $("#f_total").html(" " + f_total.toFixed(2));
        $("#t_quantity").html(t_quantity);
        $("#t_items").html(count);
        $('input[name="total_amount"]').val(f_total.toFixed(2));
        $('input[name="t_amount"]').val(f_total.toFixed(2));
        $('input[name="total_samount"]').val(f_total.toFixed(2));

        $tr.find(".qty_text").toggle();
        $tr.find(".qty_hidden").toggle();
        $tr.find(".discount_hidden").toggle();
        $tr.find(".discount_text").toggle();
        $tr.find(".btn-info").toggle();
        $tr.find(".btn-danger").toggle();
        $tr.find(".btn-secondary").toggle();
        $("#savebtn").removeAttr("hidden");
    }

}
// updatesrow

// update sale row
function updatesrow(btn, srem, sqty) {
    var qa = Number(srem) + Number(sqty);
    let quantity = $tr.find(".qty_hidden").val();
    if (Number(qa) < Number(quantity)) {
        $tr.find(".qty_hidden").val(qa);
        alert("Maximun Quantity available for Selection is " + qa);
    }
    if (Number(quantity) <= 0.9999999) {
        $tr.find(".qty_hidden").val(1);
        alert("Minimun Quantity Selected is 1");
    } else {
        $tr = $(btn).closest("tr");
        let newqty = $tr.find(".qty_hidden").val();
        let newdiscount = $tr.find(".discount_hidden").val();
        let price = $tr.find(".price_text").text();

        // calculate sub total
        let netdiscount = Number(price) * Number(newdiscount);
        netdiscount = netdiscount / 100;
        let net_price = Number(price) - Number(netdiscount);
        var subtotal = net_price * Number(newqty);
        subtotal = subtotal.toFixed(1);


        //assign values
        $tr.find(".qty_hidden").attr("value", newqty);
        $tr.find(".discount_hidden").attr("value", newdiscount);
        $tr.find(".netprice_hidden").attr("value", net_price);
        $tr.find(".qty_text").text(newqty);
        $tr.find(".discount_text").text(newdiscount);
        $tr.find(".netprice_text").text(net_price);
        $tr.find(".subtotal_text").text(subtotal);

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
        $("#t_quantity").html(t_quantity.toCurrency());
        $("#t_items").html(count);
        $('input[name="total_amount"]').val(f_total);
        $('input[name="t_amount"]').val(f_total);
        $('input[name="total_samount"]').val(f_total);

        $tr.find(".qty_text").toggle();
        $tr.find(".qty_hidden").toggle();
        $tr.find(".discount_hidden").toggle();
        $tr.find(".discount_text").toggle();
        $tr.find(".btn-info").toggle();
        $tr.find(".btn-danger").toggle();
        $tr.find(".btn-secondary").toggle();

        $("#updatebtn").removeAttr("hidden");

    }
}

// Sale Invoice
function printbtn(saleid) {
    var printWindow = window.open("/saleinvoice/" + saleid);
    printWindow.addEventListener(
        "load",
        function() {
            if (Boolean(printWindow.chrome)) {
                printWindow.print();
                setTimeout(function() {
                    printWindow.close();
                }, 500);
            } else {
                printWindow.print();
                printWindow.close();
            }
        },
        true
    );
}
/////////////////mandi purchase////////////////////
function mandi_purchase_printbtn(purchaseid) {
    var printWindow = window.open("/mandipurchaseinvoice/" + purchaseid);
    printWindow.addEventListener(
        "load",
        function() {
            if (Boolean(printWindow.chrome)) {
                printWindow.print();
                setTimeout(function() {
                    printWindow.close();
                }, 500);
            } else {
                printWindow.print();
                printWindow.close();
            }
        },
        true
    );
}


function duplicateItemName(element){
    var Item = $(element).val();
    $("#save_item").attr("disabled", true);
    console.log(Item);
    $.ajax({
        type: "POST",
        url: '/checkitem',
        data: {item_name:Item},
        dataType: "json",
        success: function(res) {
            if(res.exists){
                $("#flash_message").css("background-color", "#FF0000");
                $("#flash_message").html('Item name already exit');
                $("#flash_message").slideUp(10000);
            }else{
                $("#save_item").attr("disabled", false);
                alert('false');
            }
        },
        error: function (jqXHR, exception) {

        }
    });
}
function editItem($id){
    $.ajax({
        type: "POST",
        url: '/checkitem',
        data: {id:$id},
        dataType: "json",
        success: function(res) {
            if(res.exists){
                $("#flash_message").css("background-color", "#FF0000");
                $("#flash_message").html('Item name already exit');
                $("#flash_message").slideUp(10000);
            }else{
                $("#save_item").attr("disabled", false);
                alert('false');
            }
        },
        error: function (jqXHR, exception) {

        }
    });
}

function mandi_sale_printbtn(saleid) {
    var printWindow = window.open("/MandiSaleInvoice/" + saleid);
    printWindow.addEventListener(
        "load",
        function() {
            if (Boolean(printWindow.chrome)) {
                printWindow.print();
                setTimeout(function() {
                    printWindow.close();
                }, 500);
            } else {
                printWindow.print();
                printWindow.close();
            }
        },
        true
    );
}


/////////////////mandi purchase////////////////////


// Purchase Invoice
function p_printbtn(purchaseid) {
    var printWindow = window.open("/purchaseinvoice/" + purchaseid);
    printWindow.addEventListener(
        "load",
        function() {
            if (Boolean(printWindow.chrome)) {
                printWindow.print();
                setTimeout(function() {
                    printWindow.close();
                }, 500);
            } else {
                printWindow.print();
                printWindow.close();
            }
        },
        true
    );
}


$("#payment_btn").click(function() {

    let cash_bank_balance = Number($('#method').find("option:selected").data('dc'));
    let current_amount = Number($('input[name="amount_paid"]').val());
    let total_amount = Number($('input[name="total_amount"]').val());
    let paid_amount = Number($('input[name="p_paid"]').val());
    let invoice_balance = total_amount - paid_amount;

    let val = $('#method').val();
    var result = val.split(',');
    val = result[3];
    if (val == -1){
        let credit = Number($('#method').find("option:selected").data('dc'));




        if (credit <= 0) {
            alert('Insufficient funds!')
            return false;
        }

        if (current_amount > credit) {
            alert('Amount cannot exceed available funds!')
            return false;
        }
    }

    if (cash_bank_balance <= 0) {
        alert('Insufficient funds!')
        return false;
    }

    if (current_amount > cash_bank_balance) {
        alert('Amount cannot exceed available funds!')
        return false;
    }

    if ( current_amount <= 0 ) {
        alert("Amount should be greater then zero");
        return;
    }

    if ( current_amount > invoice_balance ) {
        alert("Amount should not exceed invoice balance of " + invoice_balance);
        return;
    }

    $("#payment_add").submit();
});

function amountCheck(cash, name) {
    $store = $('input[name="name"]').val(name);
    $("#regadd").hide();
    $("#regupdate").removeAttr("hidden");
    $("#regform").prop("action", "/regionupdate/" + id);
}
// payment for sale
$("#sale_add").click(function() {

    let total_amount = Number($('input[name="total_amount"]').val());
    let current_amount = Number($('input[name="amount_paid"]').val());
    let paid_amount = Number($('input[name="p_paid"]').val());
    let invoice_balance = total_amount - paid_amount;

    let val = $('#method').val();
    var result = val.split(',');
    val = result[3];
    if (val == -1){
    let credit = Number($('#method').find("option:selected").data('dc'));




        if (credit <= 0) {
            alert('Insufficient funds!')
            return false;
        }

        if (current_amount > credit) {
            alert('Amount cannot exceed available funds!')
            return false;
        }
    }

    if ( current_amount <= 0 ) {
        alert("Amount should be greater then zero");
        return;
    }

    if ( current_amount > total_amount ) {
        alert("Amount should not exceed invoice balance of " + invoice_balance);
        return;
    }



    $("#sale_payment").submit();
});
$('#method').change(function() {
    let credit = Number($('#method').find("option:selected").data('dc') || 0);
    let total_amount = Number($('input[name="total_amount"]').val() || 0);
    let paid_amount = Number($('input[name="p_paid"]').val() || 0);
    let blns = total_amount - paid_amount;

    let val = $('#method').val();
    var result = val.split(',');
    val = result[3];
    if (val == -1){
        if ( credit > blns){
            $('input[name="amount_paid"]').val(blns);
        }else {
            $('input[name="amount_paid"]').val(credit);
        }
    } else {
        $('input[name="amount_paid"]').val(blns);
    }

});
