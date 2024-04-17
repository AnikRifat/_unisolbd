$(document).ready(function() {
    $('#vendorForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Serialize the form data
        var formData = new FormData(this);

        if (type === 'purchase') {
            formData.append('type', 1);
        }
        else{
            formData.append('type', 2);
        }

        // Make the Ajax request
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), // Get the form's action attribute
            data: formData,
            processData: false, // Don't process the data (needed for file uploads)
            contentType: false, // Don't set content type (needed for file uploads)
            dataType: 'json', // Expect JSON response (adjust as needed)

            success: function(response) {
                // Handle the success response here
                console.log(response);
                showToastr(response.notification.type, response.notification.message)
                var selectElement = $('#vendor_id');
                selectElement.empty(); // Clear existing options
                if(type === 'purchase'){
                selectElement.append('<option value="">Choose Supplier</option>'); // Add the default option
                }
                else{
                selectElement.append('<option value="">Choose Customer</option>'); // Add the default option
                }
                // Add options for each supplier from the response
                $.each(response.vendors, function(index, vendor) {
                    selectElement.append('<option value="' + vendor.id +
                        '">' + vendor.name + '</option>');
                });

                // Close the modal (adjust the selector and method based on your modal library)
                $('#vendorModal').modal('hide');
                vendorForm();
            },

            error: function(xhr, textStatus, errorThrown) {
                // Handle any errors here
                console.error(errorThrown);
                requestValidate(xhr);
            }
        });
    });


    function requestValidate(xhr) {
        $('.errorMessage').remove();
        // Handle the validation errors if they exist in the response
        if (xhr.responseJSON && xhr.responseJSON.errors) {
            $.each(xhr.responseJSON.errors, function(fieldName, errorMessages) {
                var errorMessage = '<span class="text-danger errorMessage">' + errorMessages[0] +
                    '</span>';
                $('#' + fieldName).after(errorMessage);
            });
        }
    }

    $('#vendorModal').on('hidden.bs.modal', function() {
        console.log("This is working ...............");
        vendorForm();
    });

    function vendorForm() {
        $('#name').val('') // Clear the select options if needed
        $('#phone').val('')
        $('#vendorForm .errorMessage').remove()
    }

});