@extends('frontend.main_master')
@section('title')
    verify register
@endsection
@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">My Account
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

		<div class="container">
			<div class="my-2 my-xl-4">
				<div class="row d-flex justify-content-center">
					<div class="col-md-5">
						<!-- Title -->
						<div class="border-bottom border-color-1 mb-2">
							<label class="d-inline-block section-title mb-0 pb-2 font-size-20">OTP Verification</label>
							<p class="d-inline-block mt-2 mb-0 pb-2 font-size-16">
								We've sent a verification code to your phone - {{ $phone }}
							</p>
							<div class="my-3">
								<p class="d-inline-block mt-2 mb-0 pb-2 font-size-16"> Resend OTP in <span id="countdowntimer">03:00</span> Minutes</p>
								<button id="resendBtn" href="" class="btn btn-primary px-2 py-1 float-right d-inline" disabled>resend</button>
							</div>
						</div>
		
						<!-- Form Group -->
						<form class="js-validate" novalidate="novalidate" method="post" action="{{ route('otp.validate') }}">
							@csrf
							<input type="hidden" name="phone" value="{{ $phone }}"> 
							<div class="js-form-message form-group mb-1">
								<label class="form-label" for="OTP">OTP
									<span class="text-danger">*</span>
								</label>
								<input type="text" class="form-control" name="otp" id="OTP" placeholder="OTP" aria-label="OTP" required data-msg="Please enter a OTP." data-error-class="u-has-error" data-success-class="u-has-success">
							</div>
		
							<div class="js-form-message form-group mb-1">
								<label class="form-label" for="Password">Password
									<span class="text-danger">*</span>
								</label>
								<input type="password" class="form-control" name="password" id="Password" placeholder="Password" aria-label="Password" required data-msg="Please enter a valid password." data-error-class="u-has-error" data-success-class="u-has-success">
							</div>
		
							<div class="js-form-message form-group mb-3">
								<label class="form-label" for="ConfirmPassword">Confirm Password
									<span class="text-danger">*</span>
								</label>
								<input type="password" class="form-control" name="password_confirmation" id="ConfirmPassword" placeholder="Confirm password" aria-label="confirm_password" required data-msg="Please enter a valid confirm password." data-error-class="u-has-error" data-success-class="u-has-success">
							</div>
							<!-- End Form Group -->
		
							<!-- Button -->
							<div class="mb-6">
								<div class="mb-3">
									<button type="submit" class="btn btn-primary px-5 btn-block">Submit</button>
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
        $(document).ready(function() {
            otpResendTimer();
        });

		function otpResendTimer() {
        var timeleft = 180; // 3 minutes (180 seconds)
        var downloadTimer = setInterval(function() {
            var minutes = Math.floor(timeleft / 60);
            var seconds = timeleft % 60;

            var formattedTime = (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
            $("#countdowntimer").text(formattedTime);

            if (timeleft <= 0) {
                clearInterval(downloadTimer);
                $("#resendBtn").prop("disabled", false); // Enable the "resend" button
            }

            timeleft--;
        }, 1000);
    }
    </script>
@endsection
