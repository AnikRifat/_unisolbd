$(document).ready(function () {
    // Attach an event listener to the input
    $("#sale_person_id").on("input", function () {
        var inputVal = $(this).val().trim().toLowerCase();
        var dataListOptions = $("#sale_person").find("option");

        // Check if the input value is in the datalist options
        var matchingOption = dataListOptions.filter(function () {
            return $(this).val().toLowerCase() === inputVal;
        });

        if (matchingOption.length > 0 || inputVal === "" || inputVal === null) {
            // Value exists in datalist
            var personId = matchingOption.data("person-id");
            $('input[name="sale_person"]').val(personId);
            $(".btnSavePerson").addClass("disabled");
        } else {
            // Value doesn't exist in datalist
            $('input[name="sale_person"]').val("");
            $(".btnSavePerson").removeClass("disabled");
        }
    });
    $(".btnSavePerson").on("click", function () {
        var name = $("#sale_person_id").val().trim();

        $.ajax({
            type: "POST",
            url: userManagementStoreRoute,
            data: {
                name: name,
            },
            dataType: "json", // Expect JSON response (adjust as needed)

            success: function (response) {
                // Handle the success response here
                console.log(response);

                // Add a new option to the datalist
                $("#sale_person").append(
                    '<option value="' +
                        name +
                        '" data-person-id="' +
                        response.salePerson.id +
                        '"></option>'
                );

                $('input[name="sale_person"]').val(response.salePerson.id);
                $(".btnSavePerson").addClass("disabled");
                showToastr(
                    response.notification.type,
                    response.notification.message
                );
            },

            error: function (xhr, textStatus, errorThrown) {
                // Handle any errors here
                console.error(xhr);
                showToastr("error", xhr.responseJSON.errors);
            },
        });
    });

});
