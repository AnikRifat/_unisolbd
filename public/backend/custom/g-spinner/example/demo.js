// var $loader = $("#loader");
// var $startBtn = $("button.start");

//  function handleStartClick() {
//     $("#g-container").removeClass("d-none");
//     // We start the spinner with <element>.gSpinner()
//     $loader.gSpinner();
// };

// $startBtn.click(function () {
//     // Check if all required fields are valid
//     var form = document.getElementById("myForm"); // Replace 'myForm' with the ID of your form
//     var isValid = true;

//     for (var i = 0; i < form.elements.length; i++) {
//         var element = form.elements[i];

//         if (element.required && !element.checkValidity()) {
//             isValid = false;
//             break;
//         }
//     }

//     if (isValid) {
//         handleStartClick();
//     } else {
//         alert("Please fill in all required fields.");
//     }
// });


var $loader = $("#loader");
var $startBtn = $("button.start");
var formSubmitted = false;

function handleStartClick() {
    // Check if the form has been submitted
    if (!formSubmitted) {
        // If not, proceed to start the spinner
        $("#g-container").removeClass("d-none");
        $loader.gSpinner();
        formSubmitted = true;
    }
}

$startBtn.click(function () {
    // Check if all required fields are valid
    var form = document.getElementById("myForm"); // Replace 'myForm' with the ID of your form
    var isValid = true;

    for (var i = 0; i < form.elements.length; i++) {
        var element = form.elements[i];

        if (element.required && !element.checkValidity()) {
            isValid = false;
            break;
        }
    }

    if (isValid) {
        handleStartClick();
        // You can also submit the form here if needed
        // form.submit();
    } else {
        alert("Please fill in all required fields.");
    }
});
