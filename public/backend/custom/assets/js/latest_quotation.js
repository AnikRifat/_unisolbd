$(document).ready(function () {
    $(document).on("change", "#vendor_id", function () {
        var customerId = $(this).val();
        console.log("customer_id", customerId);

        if (customerId !== "") {
            console.log("customerId !== ", customerId);

            console.log("type : ",type);
            // Use a function to dynamically generate the URL with the current customer ID
            var latestQuotationUrl = function () {
                return latestQuotation.replace(":id", customerId);
            };

            // Add a condition based on the type variable
            if (type === 'quotation' || type === 'edit' || type === 'invoice') {
                $.ajax({
                    type: "GET",
                    url: latestQuotationUrl(),
                    dataType: "json",
                    success: function (response) {
                        console.log("result", response);
                        if (response.customerPackage != null) {
                            $("#to").val(response.customerPackage.to);
                            $("#subject").val(response.customerPackage.subject);
                        } else {
                            $("#to").val("");
                            $("#subject").val("");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText); // Log the error response for debugging
                    },
                });
            }
        } else {
            $("#to").val("");
            $("#subject").val("");
        }
    });
});

