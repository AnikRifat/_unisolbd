var selectedProductId;
// Set up event listener for the change event on the product select load selling price and descritption
$("#item-list").on("change", ".product-select", function () {
    var currentRow = $(this).closest("tr");
    var selectedProductName = $(this).val();

    var selectedOption = $(
        '#products option[value="' + selectedProductName + '"]'
    );

    var selectedProductId = selectedOption.data("product-id")
        ? selectedOption.data("product-id")
        : selectedProductId;
    // Find the product_id input within the current row and set its value

    console.log("selectedProductId from change", selectedProductId);

    var product_id = currentRow.find(".product-id-input").val();
    console.log("currentRow product-id-input", product_id);

    if (selectedProductId != undefined) {
        if (
            product_id == "" ||
            product_id != selectedProductId ||
            product_id != undefined
        ) {
            currentRow.find(".product-id-input").val(selectedProductId);
            if (selectedProductId != undefined) {
                productInfo(selectedProductId, currentRow);
            } else {
                productInfo(product_id, currentRow);
            }
        }
    }
    

   
});


function productInfo(selectedProductId, currentRow) {
    $.ajax({
        type: "get",
        url: latestProductInfo,
        data: {
            id: selectedProductId,
        },
        dataType: "json",
        success: function (response) {
            console.log(response);

            currentRow
                .find(".unit-id")
                .val(response.product.unit.id)
                .trigger("change");

            if (type === "purchase") {
                currentRow
                    .find(".rate")
                    .val(
                        response.latestPurchase != null
                            ? response.latestPurchase.price
                            : response.product.purchase_price
                    );
            } else {
                currentRow
                    .find(".rate")
                    .val(
                        response.latestSale !== null
                            ? response.latestSale.price
                            : response.product.selling_price
                    );

                currentRow
                    .find(".purchase-price")
                    .val(
                        response.latestPurchase != null
                            ? response.latestPurchase.price
                            : response.product.purchase_price
                    );
            }
            currentRow
                .find(".description")
                .val(response.product.quotation_short_descp);
            calculateAllSales();
        },
    });
}

//update product name,description,unit,price

function handleChange(element, className, propertyName) {
    var currentRow = $(element).closest("tr");
    var product_id = parseInt(currentRow.find(".product-id-input").val());

    if (product_id !== "") {
        var selectedValue = $(element).val();

        console.log("selectedValue : ", selectedValue);

        // Find the product in the original products array where selectedProductId matches
        var originalProduct = products.find(
            (product) => product.id === product_id
        );

        console.log("Product Check Property : ", originalProduct[propertyName]);
        console.log(
            "Checked : ",
            originalProduct && originalProduct[propertyName] !== selectedValue
        );

        // Compare the original product's property with the current selected value
        if (
            originalProduct &&
            String(originalProduct[propertyName]) !== String(selectedValue)
        ) {
            // Call an AJAX method to save in the database
            updateQuotationProduct(product_id, selectedValue, propertyName)
                .then(function (response) {
                    var indexToUpdate = products.findIndex(
                        (product) => product.id === product_id
                    );

                    if (indexToUpdate !== -1) {
                        products[indexToUpdate][propertyName] = selectedValue;
                        console.log(response);

                        $(".product_td").each(function () {
                            var productIdInput =
                                $(this).find(".product-id-input");
                            var productId = parseInt(productIdInput.val());

                            console.log("productId : ", productId);

                            if (productId === parseInt(product_id)) {
                                console.log(
                                    "productId === parseInt(product_id : ",
                                    productId
                                );
                                console.log("element : ", element);
                                var targetElement = $(this)
                                    .closest("tr")
                                    .find(className);
                                targetElement
                                    .val(selectedValue)
                                    .trigger("change");
                            }
                        });

                        if (propertyName == "quotation_product_name") {
                            var datalist = $("#products");
                            var optionToUpdate = datalist.find(
                                '[data-product-id="' + product_id + '"]'
                            );
                            optionToUpdate.attr("value", selectedValue);
                        }

                        showToastr(
                            response.notification.type,
                            response.notification.message
                        );
                        selectedProductId = undefined;
                    }
                })
                .catch(function (error) {
                    console.error(
                        "Error updating quotation product " +
                            propertyName +
                            ":",
                        error
                    );
                    // Handle the error, show a message, or perform other actions as needed
                });
        }
    }
}

function updateQuotationProduct(product_id, selectedValue, propertyName) {
    return $.ajax({
        type: "POST",
        url: updateProduct.replace(":id", product_id),
        data: {
            [propertyName]: selectedValue,
        },
        dataType: "JSON",
    });
}

//check cursor move invalid field validation
function isValidInput(input) {
    // Check if the input value is not empty
    var value = input.val().trim();
    if (value === "") {
        // Add a border to indicate an issue
        input.css("border", "1px solid red");
        return false;
    } else {
        // Reset the border
        input.css("border", "");
        return true;
    }
}

function isRowValid(row) {
    // Check if all cells in the row are filled except for the discount cell
    var isValid = true;

    row.find(
        ".product-select,.description,.unit-id, .qty,.purchase-price,.rate"
    ).each(function () {
        if ($(this).hasClass("unit-id")) {
            // Check if the select2 value is not empty
            if (
                $(this)
                    .next()
                    .find(".select2-selection")
                    .hasClass("select2-selection--single") &&
                !isValidInput($(this))
            ) {
                isValid = false;
                // Set border color to red for the empty cell
                $(this)
                    .next()
                    .find(".select2-selection")
                    .css("border-color", "red");
            }
        } else {
            // Check if other input values are not empty
            if (!isValidInput($(this))) {
                isValid = false;
                // Set border color to red for the empty cell
                $(this).css("border-color", "red");
            }
        }
    });

    return isValid;
}

//show and hide table footer. total,discount, net payable
function updateVisibility() {
    // Check if there are rows in the table body
    var hasRows = $("#addRow tr").length > 0;

    // Toggle the d-none class on the tfoot and btnSubmit elements
    $("#tFooter").toggleClass("d-none", !hasRows);
    $("#btnSubmit").toggleClass("d-none", !hasRows);
}

//save and update in database..............
function checkQuotationItems() {
    // Select all elements with names starting with "product_id" and "total"
    var productIds = $('input[name="product_id[]"]')
        .map(function () {
            return $(this).val();
        })
        .get();

    var totals = $('input[name="total[]"]')
        .map(function () {
            return $(this).val();
        })
        .get();

    // Check if both arrays have at least one element
    if (productIds.some(Boolean) && totals.some(Boolean)) {
        return true;
    } else {
        showToastr("error", "No items to create the quotation.");
    }
}

$(document).ready(function () {

//cursor move in next filed
$(document).on("keydown", "#item-list .product-select, #item-list .description, #item-list .unit-id, #item-list .qty, #item-list .purchase-price, #item-list .rate, #item-list .discount-price, #item-list #total_discount", function (event) {
    if (event.keyCode === 13) {
        // Enter key
        event.preventDefault();
    }

    var row = $(this).closest("tr");
    calculateSales(row);
    calculateGrantTotal();
    calculateNetPayable();

    // Move cursor to the next input field (discount price) after typing quantity or sale price
    if (event.keyCode === 13) {
        // Enter key
        event.preventDefault();
        if ($(this).hasClass("product-select")) {
            var descriptionInput = row.find(".description");
            if (isValidInput($(this))) {
                handleChange(
                    $(this),
                    ".product-select",
                    "quotation_product_name"
                );
                if (row.find(".product-id-input").val() != "") {
                    descriptionInput.focus();
                } else {
                    isValidInput($(this));

                    Swal.fire({
                        icon: "error",
                        title: "Select a product..!!",
                    });
                    // console.log('selectedProductId : ', selectedProductId)
                }
            }
        } else if ($(this).hasClass("description")) {
            console.log("Entering description block");
            var unitInput = row.find(".unit-id");
            if (isValidInput($(this))) {
                console.log("Triggering select2:open event");
                handleChange(
                    $(this),
                    ".description",
                    "quotation_short_descp"
                );
                unitInput.focus();

                // Trigger the select2:open event to open the dropdown
                // unitInput.select2('open');
            }
        } else if ($(this).hasClass("unit-id")) {
            var qtyInput = row.find(".qty");
            if (isValidInput($(this))) {
                console.log("Moving focus to qty");
                row.find(".unit-id").select2("close");
                qtyInput.focus();
            }
        } else if ($(this).hasClass("qty")) {
            var purchasePriceInput = row.find(".purchase-price");
            nextInput =
                purchasePriceInput.length > 0
                    ? purchasePriceInput
                    : row.find(".rate");
            if (isValidInput($(this))) {
                nextInput.focus();
            }
        } else if ($(this).hasClass("purchase-price")) {
            var salePriceInput = row.find(".rate");
            if (isValidInput($(this))) {
                handleChange($(this), ".purchase-price", "purchase_price");
                salePriceInput.focus();
            }
        } else if ($(this).hasClass("rate")) {
            var discountPriceInput = row.find(".discount-price");
            if (isValidInput($(this))) {
                discountPriceInput.focus();
            }
        } else if ($(this).hasClass("discount-price")) {
            // Check if all cells in the row are filled except for the discount cell
            var isValidRow = isRowValid(row);

            // Optionally, add new row logic here
            if (isValidRow) {
                // if(customerPackageId!="undefined"){
                //     addNewQuotationItem(row);
                // }
                addNewRow();
            }
        }
    }
}
);

$(document).on("select2:open", "#item-list .unit-id", function (e) {
console.log("i am form select2:open");

var productId = $(this).closest("tr").find(".product-id-input").val();

console.log("productId : ", productId);

// Get the Select2 dropdown element
var select2Dropdown = $(this).data("select2").$dropdown;

// Unbind previous keydown event to avoid accumulation
select2Dropdown.off("keydown");

// Event listener for keydown on the Select2 dropdown
select2Dropdown.on("keydown", function (event) {
    // Check if the pressed key is Enter (key code 13)
    if (event.keyCode === 13) {
        // Find the selected option and get its value (unit_id)
        var selectedOption = $(e.target).find(":selected");
        var unitId = selectedOption.val();

        handleChange(e.target, ".unit-id", "unit_id");

        console.log("Selected unit_id: ", unitId);

        var row = $(e.target).closest("tr");
        var qtyInput = row.find(".qty");

        // Delay the focus change after a short timeout
        setTimeout(function () {
            qtyInput.focus();
        }, 100);
    }
});
});

});