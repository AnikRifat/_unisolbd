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
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><a href="{{ route('register') }}">Register</a></li>
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
                    <div class="col-md-5 m-5">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-6">
                            <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Register</h3>
                        </div>
                        <!-- Form Group -->
                        <form class="js-validate" novalidate="novalidate" method="post" action="{{ route('register.store') }}">
                            @csrf
                            <div class="js-form-message form-group mb-1">
                                <label class="form-label" for="RegisterSrNameExample3">Full Name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="name" id="RegisterSrNameExample3"
                                    placeholder="Full name" aria-label="Full name" required
                                    data-msg="Please enter a valid name." data-error-class="u-has-error"
                                    data-success-class="u-has-success" value="{{ old('name') }}">
                                <!-- Display the old value from the form submission, if any -->
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    <!-- Display the validation error message, if any -->
                                @enderror
                            </div>

                            <div class="js-form-message form-group mb-3">
                                <label class="form-label" for="RegisterSrPhoneExample3">Phone
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="phone" id="RegisterSrPhoneExample3"
                                    placeholder="Phone" aria-label="Phone" required
                                    data-msg="Please enter a valid phone number." data-error-class="u-has-error"
                                    data-success-class="u-has-success" value="{{ old('phone') }}">
                                <!-- Display the old value from the form submission, if any -->
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    <!-- Display the validation error message, if any -->
                                @enderror
                            </div>

                            {{-- Add Email field if needed --}}
                            @if(config('jetstream.features.registration.email'))
                                <div class="js-form-message form-group mb-3">
                                    <label class="form-label" for="RegisterSrEmailExample3">Email address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" name="email" id="RegisterSrEmailExample3"
                                        placeholder="Email address" aria-label="Email address" required
                                        data-msg="Please enter a valid email address." data-error-class="u-has-error"
                                        data-success-class="u-has-success" value="{{ old('email') }}">
                                    <!-- Display the old value from the form submission, if any -->
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        <!-- Display the validation error message, if any -->
                                    @enderror
                                </div>
                            @endif

                            <div class="js-form-message form-group mb-3">
                                <label class="form-label" for="RegisterSrPasswordExample3">Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="password" id="RegisterSrPasswordExample3"
                                    placeholder="Password" aria-label="Password" required
                                    data-msg="Please enter a valid password." data-error-class="u-has-error"
                                    data-success-class="u-has-success" value="{{ old('password') }}">
                                <!-- Display the validation error message, if any -->
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="js-form-message form-group mb-3">
                                <label class="form-label" for="RegisterSrConfirmPasswordExample3">Confirm Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="RegisterSrConfirmPasswordExample3" placeholder="Confirm password"
                                    aria-label="confirm_password" required
                                    data-msg="Please enter a valid confirm password." data-error-class="u-has-error"
                                    data-success-class="u-has-success" value="{{ old('password_confirmation') }}">
                                <!-- Display the validation error message, if any -->
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- End Form Group -->

                            <!-- Button -->
                            <div class="mb-6">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary px-5 btn-block">Register</button>
                                </div>
                                <div class="mb-3 text-center">
                                    <p class="text-gray-90 mb-4">Already have an account?</p>
                                </div>


                                <div class="mb-3">
                                    <a href="{{ route('login') }}"  type="submit" class="btn btn-soft-primary border border-primary px-5 btn-block">Login</a>
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
@endsection
