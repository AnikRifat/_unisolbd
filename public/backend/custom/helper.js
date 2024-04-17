$(document).ready(function () {
    // Attach the input validation to all elements with the 'decimal-input' class
    $(document).on("input", ".decimal-input", function (event) {
        var input = $(this);
        var inputValue = input.val();

        // Check if the input value contains non-digit characters or multiple decimal points
        if (/[^0-9.]/.test(inputValue) || inputValue.split(".").length > 2) {
            input.val(
                inputValue.replace(/[^0-9.]/g, "").replace(/(\..*)\./g, "$1")
            );
        }
    });

    $(document).on("input", ".numeric-input", function () {
        var inputValue = $(this).val();
        $(this).val(inputValue.replace(/[^0-9]/g, ""));
    });

    //allow number and percentage both
    $(document).on("input", ".discount-input", function () {
        var input = $(this);
        var value = input.val();

        // Remove any non-digit characters except for the percentage symbol
        value = value.replace(/[^0-9%]/g, "");

        // Ensure the percentage symbol is at most one and at the end of the input
        value = value.replace(/%+/g, "%");
        value = value.replace(/%([^%]*)$/, "%$1");

        // Update the input value
        input.val(value);
    });
});

$(document).ready(function () {
    // Get the current date
    var currentDate = new Date();

    // Format the date as "YYYY-MM-DD" to match the input type="date" format
    var formattedDate = currentDate.toISOString().slice(0, 10);

    // Set the formatted date as the value of the input
    $(".current-date").val(formattedDate);
});

function showToastr(type, message) {
    switch (type) {
        case "info":
            toastr.info(message, type);
            break;
        case "warning":
            toastr.warning(message, type);
            break;
        case "success":
            toastr.success(message, type);
            break;
        case "error":
            toastr.error(message, type);
            break;
        default:
            toastr.info(message, type);
            break;
    }
}

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

