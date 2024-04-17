$(document).ready(function() {
            
     //add product button work here .....
    $('#productForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Synchronize CKEditor content with the textarea
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        // Serialize the form data
        var formData = new FormData(this);

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

                // Update the products array with the new product
                products.push(response.product);

                // Update the datalist options
                updateDatalist();


                showToastr(response.notification.type, response.notification.message)
                $('#productModal').modal('hide');
            },

            error: function(xhr, textStatus, errorThrown) {
                console.log("xhr : ", xhr);
                requestValidate(xhr);
            }
        });
    });

    $('#productModal').on('hidden.bs.modal', function() {
        console.log("This is working ...............");
        $('#productForm .errorMessage').remove();

        // Reset the form using vanilla JavaScript
        $('#productForm')[0].reset();


    });

    function requestValidate(xhr) {
        $('.errorMessage').remove();

        // console.log("xhr.responseJSON.errors : ",xhr.responseJSON.errors)
        // Handle the validation errors if they exist in the response
        if (xhr.responseJSON && xhr.responseJSON.errors) {

            $.each(xhr.responseJSON.errors, function(fieldName, errorMessages) {
                var errorMessage = '<span class="text-danger errorMessage">' + errorMessages[0] +
                    '</span>';
                $('#' + fieldName).after(errorMessage);
            });
        }
    }

    $('input[name="type"]').change(function() {
        if ($(this).is(':checked')) {
            console.log('Checked radio value:', $(this).val());

            if ($(this).val() == 1) {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to proceed?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = productCreate; // Replace with your target page URL
                    } else {
                        $('#POS').prop('checked', true);
                    }
                });
            }
        }
    });
});