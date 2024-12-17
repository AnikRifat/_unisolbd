$(document).ready(function () {
    const passwordEl = document.querySelector("#password");
    const confirmPasswordEl = document.querySelector("#password_confirmation");
    console.log("pel : ", confirmPasswordEl);
    
    const form = document.querySelector("#password-update-form");

    const checkPassword = () => {
        let valid = false;

        console.log(" password value : "+passwordEl.value);
        const password = passwordEl.value.trim();

        if (!isRequired(password)) {
            showError(passwordEl, "Password cannot be blank.");
        } else if (!isPasswordSecure(password)) {
            showError(
                passwordEl,
                "Password must has at least 8 characters that include at least 1 lowercase character, 1 uppercase characters, 1 number, and 1 special character in (!@#$%^&*)"
            );
        } else {
            showSuccess(passwordEl);
            valid = true;
        }

        return valid;
    };

    const checkConfirmPassword = () => {
        let valid = false;
        // check confirm password
        const confirmPassword = confirmPasswordEl.value.trim();
        console.log("passwor confirmation : "+confirmPassword)
        const password = passwordEl.value.trim();

        if (!isRequired(confirmPassword)) {
            showError(confirmPasswordEl, "Please enter the password again");
        } else if (password !== confirmPassword) {
            showError(confirmPasswordEl, "The password does not match");
        } else {
            showSuccess(confirmPasswordEl);
            valid = true;
        }

        return valid;
    };

    const isPasswordSecure = (password) => {
        const re = new RegExp(
            "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})"
        );
        return re.test(password);
    };

    const isRequired = (value) => (value === "" ? false : true);
    const isBetween = (length, min, max) =>
        length < min || length > max ? false : true;

    const showError = (input, message) => {
        // get the form-field element
        console.log("input : ",input)
        const formField = input.parentElement.parentElement;
        console.log("formField : ",formField)
        // add the error class
        formField.classList.remove("success");
        formField.classList.add("error");

        // show the error message
        const error = formField.querySelector(".error-message");
        error.textContent = message;
    };

    const showSuccess = (input) => {
        
        console.log("input : ",input)
        // get the form-field element
        const formField = input.parentElement.parentElement;
        console.log("formField : ",formField)
        // remove the error class
        formField.classList.remove("error");
        formField.classList.add("success");

        // hide the error message
        const error = formField.querySelector(".error-message");
        error.textContent = "";
    };

    form.addEventListener("submit", function (e) {
        // prevent the form from submitting
        e.preventDefault();

        // validate fields
        let isPasswordValid = checkPassword(),
            isConfirmPasswordValid = checkConfirmPassword();

        let isFormValid = isPasswordValid && isConfirmPasswordValid;

        // submit to the server if the form is valid
        if (isFormValid) {
            perform($(this)); 
        }
    });

    const debounce = (fn, delay = 500) => {
        let timeoutId;
        return (...args) => {
            // cancel the previous timer
            if (timeoutId) {
                clearTimeout(timeoutId);
            }
            // setup a new timer
            timeoutId = setTimeout(() => {
                fn.apply(null, args);
            }, delay);
        };
    };

    form.addEventListener(
        "input",
        debounce(function (e) {
            switch (e.target.id) {
                case "password":
                    checkPassword();
                    break;
                case "password_confirmation":
                    checkConfirmPassword();
                    break;
            }
        })
    );
});




    $(document).ready(function () {
    $('#toggle-password').click(function () {
        togglePasswordVisibility('#password', '#toggle-password');
    });

    $('#toggle-password-confirmation').click(function () {
        togglePasswordVisibility('#password_confirmation', '#toggle-password-confirmation');
    });

    function togglePasswordVisibility(inputId, iconId) {
        const passwordInput = $(inputId);
        const passwordType = passwordInput.attr('type');
        const icon = $(iconId);

        if (passwordType === 'password') {
            passwordInput.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordInput.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    }
});
