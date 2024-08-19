// Assuming your quantity and sale price inputs have the classes 'qty' and 'rate'
$(document).on(
    "keyup",
    ".qty, .rate, .discount-price, #total_discount, #item-list #totalPaid",
    function (event) {
        // console.log("event.keyCode : ", $('#total_discount').val());
        if (event.keyCode === 13) {
            // Check for Enter key
            event.preventDefault();
            return false; // Stop further processing
        }
        // Check if the keyup event is on #total_discount
        if ($(event.target).is("#total_discount")) {
            // Perform specific action for #total_discount
            $("#addRow tr").each(function () {
                $(this).find(".discount-price").val(null);
                calculateSales($(this));
            });
            console.log("i am from .discount-price : ");
        }

        if ($(event.target).is(".discount-price")) {
            $("#total_discount").val("");
            console.log("i am form total_discount : ");
        }

        var row = $(this).closest("tr");
        calculateSales(row);
        calculateGrantTotal();
        calculateNetPayable();
        calculateTotalDue();
    }
);

function calculateAllSales() {
    $("#item-list tr").each(function () {
        calculateSales($(this));
    });
    calculateGrantTotal();
    calculateNetPayable();
    calculateTotalDue();
}

function calculateGrantTotal() {
    var grantTotal = 0;
    $("#addRow tr").each(function () {
        var subtotal =
            parseFloat($(this).find('input[name="total[]"]').val()) || 0;
        grantTotal += subtotal;
    });
    $('input[name="grand_total"]').val(Math.round(grantTotal));
}

function calculateNetPayable() {
    var totalAmount = parseFloat($('input[name="grand_total"]').val());

    var totalDiscount = $('input[name="total_discount"]').val().trim();
    var netPayable = 0;

    var discountPrice = 0;

    var percentageRegex = /^(\d+(\.\d+)?)%$/; // Regex pattern to match percentage values

    if (percentageRegex.test(totalDiscount)) {
        // If the discount matches the percentage pattern, calculate it as a percentage
        var discountValue = parseFloat(totalDiscount.replace("%", ""));
        discountPrice = (discountValue / 100) * totalAmount;
    } else {
        // If the discount is a direct value, use it as the discount amount
        discountPrice = parseFloat(totalDiscount) || 0;
    }

    netPayable = totalAmount - discountPrice;

    $('input[name="net_payable"]').val(Math.round(netPayable));
}

function calculateTotalDue() {
    var netPayable = parseFloat($("#netPayable").val());
    var totalPaid = 0;
    if ($("#totalPaid").val() != "") {
        totalPaid = parseFloat($("#totalPaid").val());
    }
    var totalDue = netPayable - totalPaid;
    $("#totalDue").val(Math.round(totalDue));
}

function calculateSales(row) {
    var quantity = parseFloat(row.find('input[name="qty[]"]').val()) || 0;
    var price = parseFloat(row.find('input[name="price[]"]').val()) || 0;
    var discount = row.find('input[name="discount_price[]"]').val();

    var discountPrice = 0;

    var percentageRegex = /^(\d+(\.\d+)?)%$/; // Regex pattern to match percentage values

    if (percentageRegex.test(discount)) {
        // If the discount matches the percentage pattern, calculate it as a percentage
        var discountValue = parseFloat(discount.replace("%", ""));
        discountPrice = (discountValue / 100) * price;
    } else {
        // If the discount is a direct value, use it as the discount amount
        discountPrice = parseFloat(discount) || 0;
    }

    var unitCost = price - discountPrice;
    var total = quantity * unitCost;

    // row.find('input[name="total[]"]').val(Math.round(total));
    row.find('input[name="total[]"]').val(
        Math.round(total) !== 0 ? Math.round(total) : ""
    );
}



// Initial calculation when the page loads
$(document).ready(function () {
    if(type === 'quotation'){
        calculateAllSales();
    }
   
});
