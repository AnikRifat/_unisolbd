@extends('frontend.main_master')
@section('title')
User Login/Register Page
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
						<li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" aria-current="page"><a
                            href="{{ route('view.package') }}">Quotation Builder</a>
                        </li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" aria-current="page">
                            <a
                            href="{{ route('view.packageDetails',(encrypt($packageDetails->first()->package->id)))  }}">{{ $packageDetails->first()->package->name }}</a>
                        </li>

                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">
                            <a
                            href="{{ route('frontend.create.package',encrypt($packageDetails->first()->package->id)) }}">Store Qutation</a>
                        </li>

                        </li>
					</ol>
				</nav>
			</div>
			<!-- End breadcrumb -->
		</div>
	</div>
	<!-- End breadcrumb -->

	<div class="container">
		<div class="my-2 my-xl-4 ">
            <div class="alert mb-0" role="alert">
               <span class="font-size-18 text-danger">"Please provide your information for saving quotations, and provide a valid email so that you can receive quotations through email."</span>
            </div>

			<div class="row justify-content-center align-items-center">
				<div class="col-md-4 m-2">

					<form method="POST" action="{{ route('frontend.store.package',$id) }}" class="js-validate" novalidate="novalidate" onsubmit="openNewTab()">
						@csrf
						<!-- Form Group -->
						<div class="js-form-message form-group">
							<label class="form-label" for="signinSrEmailExample3">Name
								<span class="text-danger">*</span>
							</label>

							<input type="text" class="form-control"  name="name" id="name" placeholder="Name" aria-label="Name" required
							data-msg="Please enter your name."
							data-error-class="u-has-error"
							data-success-class="u-has-success">

                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

						</div>
						<!-- End Form Group -->

                        <!-- Form Group -->
						<div class="js-form-message form-group">
							<label class="form-label" for="signinSrEmailExample3">Email
								<span class="text-danger">*</span>
							</label>

							<input type="email" class="form-control"  name="email" id="email" placeholder="Email" aria-label="Email" required
							data-msg="Please enter a email."
							data-error-class="u-has-error"
							data-success-class="u-has-success">

                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

						</div>
						<!-- End Form Group -->

						<!-- Form Group -->
						<div class="js-form-message form-group">
							<label class="form-label" for="signinSrPasswordExample2">Phone <span class="text-danger">*</span></label>

							<div class="input-icon">
							<input type="text" class="form-control"  name="phone" id="phone" placeholder="Phone" aria-label="Phone" required
							data-msg="Your password is invalid. Please try again."
							data-error-class="u-has-error"
							data-success-class="u-has-success">

                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
						    </div>
						</div>

                         <!-- Form Group -->
						<div class="js-form-message form-group">
							<label class="form-label" for="signinSrEmailExample3">Company Name
								<span class="text-danger">*</span>
							</label>

							<input type="text" class="form-control"  name="company_name" id="company_name" placeholder="company name" aria-label="Email" required
							data-msg="Please enter a company name."
							data-error-class="u-has-error"
							data-success-class="u-has-success">

                            @error('company_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

						</div>
						<!-- End Form Group -->

						<div class="m-3">
							<div class="mb-3">
								<button id="btnSubmit"   type="submit" class="btn btn-soft-primary border border-primary px-5 btn-block">Save Quotation</a>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


{{-- <script>
    $(document).ready(function() {
        $('form').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Get the values of name, email, and phone from the form
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();

            // Construct the URL with query parameters
            var url = '{{ route('package.report') }}' +
                      '?id={{ $id }}' +
                      '&name=' + encodeURIComponent(name) +
                      '&email=' + encodeURIComponent(email) +
                      '&phone=' + encodeURIComponent(phone);

            // Open a new tab with the constructed URL
            window.open(url, '_blank');
        });
    });
</script> --}}


{{-- <script>
    $(document).ready(function() {
        $('form').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Get the values of name, email, and phone from the form
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();

            // Construct the URL with query parameters
            var url = '{{ route('package.report') }}' +
                      '?id={{ $id }}' +
                      '&name=' + encodeURIComponent(name) +
                      '&email=' + encodeURIComponent(email) +
                      '&phone=' + encodeURIComponent(phone);

            // Open a new tab with the constructed URL
            window.open(url, '_blank');
        });
    });
</script> --}}


{{-- <script>
    $('form').submit(function(e) {
        var customerPackageId = {{ session('customerPackageId') ?? 'null' }};
        e.preventDefault(); // Prevent the default form submission

        // Construct the URL with query parameters
        var url = '{{ route('package.report') }}' +
                  '?id=' + customerPackageId; // Include customerPackageId if needed

        window.open(url, '_blank');
    });
</script> --}}


{{-- <script>
    // Check if customerPackageId is available in the session
    var customerPackageId = {{ session('customerPackageId') ?? 'null' }};

    if (customerPackageId !== null) {
        // If customerPackageId is available, construct the URL and open a new tab
        var url = '{{ route('preview.quotation-report') }}' +
                  '?id=' + customerPackageId; // Include customerPackageId if needed
        // Open a new tab with the constructed URL
        window.open(url, '_blank');
    }
</script> --}}





@endsection
