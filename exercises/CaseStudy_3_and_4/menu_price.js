function roundTwoDecimal(number) {
    return (Math.round(number * 100) / 100).toFixed(2);
}

function checkChanges() {
    const jjQty = document.querySelector('input[name="jj_quantity"]');
    var jjSubtotal = jjQty.value*2;
    var jjSubtotal_rounded = roundTwoDecimal(jjSubtotal);
    document.getElementById("jj_sub").innerHTML = "$" + jjSubtotal_rounded;

    const clRbs = document.querySelectorAll('input[name="cl_shotchoice"]');
    const clQty = document.querySelector('input[name="cl_quantity"]');
    let clSelectedValue;
    for (const rb of clRbs) {
        if (rb.checked) {
            clSelectedValue = rb.value;
            break;
        }
    }
    if (clSelectedValue=="single") {
        var clShotPrice = 2;
    }
    else if (clSelectedValue=="double") {
        var clShotPrice = 3;
    }
    // console.log(shotPrice, selectedValue);
    var clSubtotal = clQty.value*clShotPrice;
    var clSubtotal_rounded = roundTwoDecimal(clSubtotal);
    document.getElementById("cl_sub").innerHTML = "$" + clSubtotal_rounded;

    const icRbs = document.querySelectorAll('input[name="ic_shotchoice"]');
    const icQty = document.querySelector('input[name="ic_quantity"]');
    let icSelectedValue;
    for (const rb of icRbs) {
        if (rb.checked) {
            icSelectedValue = rb.value;
            break;
        }
    }
    if (icSelectedValue=="single") {
        var icShotPrice = 4.75;
    }
    else if (icSelectedValue=="double") {
        var icShotPrice = 5.75;
    }
    var icSubtotal = icQty.value*icShotPrice;
    var icSubtotal_rounded = roundTwoDecimal(icSubtotal)
    document.getElementById("ic_sub").innerHTML = "$" + icSubtotal_rounded;

    var totalPrice = jjSubtotal + clSubtotal + icSubtotal;
    totalPrice = roundTwoDecimal(totalPrice);
    document.getElementById("total_price").innerHTML = "$" + totalPrice;
}

var jjQuantity = document.getElementById("jj_quantity");
var clSingleShot = document.getElementById("cl_singleshot");
var clDoubleShot = document.getElementById("cl_doubleshot");
var clQuantity = document.getElementById("cl_quantity");
var icSingleShot = document.getElementById("ic_singleshot");
var icDoubleShot = document.getElementById("ic_doubleshot");
var icQuantity = document.getElementById("ic_quantity");

jjQuantity.addEventListener("change", checkChanges, false);
clSingleShot.addEventListener("change", checkChanges, false);
clDoubleShot.addEventListener("change", checkChanges, false);
clQuantity.addEventListener("change", checkChanges, false);
icSingleShot.addEventListener("change", checkChanges, false);
icDoubleShot.addEventListener("change", checkChanges, false);
icQuantity.addEventListener("change", checkChanges, false);