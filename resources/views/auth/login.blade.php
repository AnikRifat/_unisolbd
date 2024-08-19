@extends('frontend.main_master')
@section('title')
User Login/Register Page
@endsection
@section('content')
<style>
    form.form-horizontal.account-register.clearfix {
        border: 2px solid rgb(221, 221, 221);
        padding: 25px;
    }



    /* Style for legend */
    legend {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Style for form groups */
    .form-group {
        margin-bottom: 20px;
    }

    /* Style for labels */
    .control-label {
        font-weight: bold;
    }

    /* Style for input fields */
    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease;
    }

    /* Style for focused input fields */
    .form-control:focus {
        outline: none;
        border-color: #007bff;
    }

    /* Style for buttons */
    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: #fff;
        background-color: #007bff;
        transition: background-color 0.3s ease;
    }

    /* Style for button hover effect */
    .btn:hover {
        background-color: #0056b3;
    }

    /* Style for checkbox label */
    .checkbox-inline {
        font-weight: normal;
    }

    /* Style for error message */
    .error-message {
        color: #dc3545;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    /* Style for agreement link */
    .agree {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .agree:hover {
        text-decoration: underline;
    }
	.input-icon {
    position: relative;
}

.input-icon i {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    cursor: pointer;
    z-index: 1;
}
</style>
 <!-- ========== MAIN CONTENT ========== -->
 <main id="content" role="main">
	<!-- breadcrumb -->
	<div class="bg-gray-13 bg-md-transparent">
		<div class="container">
			<!-- breadcrumb -->
			<div class="my-md-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
						<li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
						<li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><a href="{{ route('login') }}">Login</a></li>
					</ol>
				</nav>
			</div>
			<!-- End breadcrumb -->
		</div>
	</div>
	<!-- End breadcrumb -->

	<div class="container">
		<div class="my-2 my-xl-4">
			<div class="row justify-content-center">
				<div class="col-md-5 m-5">
					<!-- Title -->
					<div class="border-bottom border-color-1 mb-6">
						<h3 class="d-inline-block section-title mb-0 pb-2 font-size-20">Login</h3>
					</div>
					<p class="text-gray-90 mb-4">Welcome back! Sign in to your account.</p>
					<!-- End Title -->

					<form method="POST" action="{{ isset($guard)? url($guard.'/login') : route('login') }}" class="js-validate" novalidate="novalidate">
						@csrf
						<!-- Form Group -->
						<div class="js-form-message form-group">
							{{-- <label class="form-label" for="signinSrEmailExample3">Username or Email address
								<span class="text-danger">*</span>
							</label> --}}

							<label class="form-label" for="signinSrEmailExample3">Phone
								<span class="text-danger">*</span>
							</label>

							<input type="text" class="form-control" value="{{ old('loginname') }}"  name="loginname" id="signinSrEmailExample3" placeholder="Phone" aria-label="Phone" required
							data-msg="Please enter a valid phone number."
							data-error-class="u-has-error"
							data-success-class="u-has-success">

						</div>
						<!-- End Form Group -->

						<!-- Form Group -->
						<div class="js-form-message form-group">
							<a class="text-blue float-right" href="javascript:void(0)">Lost your password?</a>
							<label class="form-label" for="signinSrPasswordExample2">Password <span class="text-danger">*</span></label>

							<div class="input-icon">
							<input type="password" class="form-control" value="{{ old('password') }}"  name="password" id="password" placeholder="Password" aria-label="Password" required
							data-msg="Your password is invalid. Please try again."
							data-error-class="u-has-error"
							data-success-class="u-has-success">
							<i class="fa fa-eye input-icon" id="toggle-password"></i>
						</div>

						</div>




						<!-- End Form Group -->
							@error('loginname')
							<span class="text-danger">
								<strong>{{ $message }}</strong>
							</span>
							@enderror

						<!-- Checkbox -->
						{{-- <div class="js-form-message mb-3">
							<div class="custom-control custom-checkbox d-flex align-items-center">
								<input type="checkbox" class="custom-control-input" id="rememberCheckbox" name="rememberCheckbox" required
								data-error-class="u-has-error"
								data-success-class="u-has-success">
								<label class="custom-control-label form-label" for="rememberCheckbox">
									Remember me
								</label>
							</div>
						</div> --}}
						<!-- End Checkbox -->

						<!-- Button -->
						<div class="m-3">
							<div class="mb-3">
								<button type="submit" class="btn btn-primary px-5 btn-block">Login</button>
							</div>

							{{-- <div class="mb-2 text-center">
								<a class="text-blue " href="#">Lost your password?</a>
							</div> --}}

							<div class="mb-3 text-center">
								<p class="text-gray-90 mb-4">Don't have an account?</p>
							</div>


							<div class="mb-3">
								<a href="{{ route('register') }}"  type="submit" class="btn btn-soft-primary border border-primary px-5 btn-block">Create Your Account</a>
							</div>
						</div>
						<!-- End Button -->
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<!-- ========== END MAIN CONTENT ========== -->

<script>
	$(document).ready(function () {
		$('#toggle-password').click(function () {
        togglePasswordVisibility('#password', '#toggle-password');
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

</script>
@endsection
