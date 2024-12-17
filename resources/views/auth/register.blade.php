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
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><a
                                    href="{{ route('register') }}">Register</a></li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
            <div class="my-2 my-xl-4">
                <div class="row d-flex justify-content-center">
                    <div class="margin-both">
                        <div id="content" class="col-sm-12">
                            <h2 class="title">Register Account</h2>
                            <p>If you already have an account with us, please login at the <a href="#">login page</a>.
                            </p>
                            <form action="{{ route('register.store') }}" method="post" enctype="multipart/form-data"
                                class="form-horizontal account-register clearfix">
                                @csrf
                                <fieldset id="account">
                                    <legend>Your Company Details</legend>
                                    <div class="form-group required" style="display: none;">
                                        <label class="col-sm-2 control-label">Customer Group</label>
                                        <div class="col-sm-10">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="customer_group_id" value="1"
                                                        checked="checked">
                                                    Default
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex col-lg-12">
                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-firstname">Company Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="company_name" value=""
                                                    placeholder="Company Name" id="input-firstname" class="form-control"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-lastname">Trade License
                                                No.</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="trade_license_number" value=""
                                                    placeholder="Trade License Number" id="input-lastname"
                                                    class="form-control" required="">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row d-flex col-lg-12">

                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-email">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" value=""
                                                    placeholder="Person Name" id="input-name"
                                                    class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-email">E-Mail</label>
                                            <div class="col-sm-9">
                                                <input type="email" name="email" value="" placeholder="E-Mail"
                                                    id="input-email" class="form-control"
                                                    required="">
                                                <div id="email_status"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-telephone">Phone
                                                Number</label>
                                            <div class="col-sm-9">
                                                <input type="tel" name="phone" value=""
                                                    placeholder="phone Number" id="input-telephone" class="form-control"
                                                    pattern="0[1-9][0-9]{9}" required="">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-address-1">Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="address" value=""
                                                    placeholder="Address" id="address" class="form-control"
                                                    required="">
                                            </div>
                                        </div>
                                    </div>




                                    <div class="row d-flex col-lg-12">
                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-nid">Owner NID</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nid_no" value=""
                                                    placeholder="National ID No."
                                                    id="input-rp-id" class="form-control" required="">
                                                <div id="nid_status"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label class="col-sm-3 control-label" for="input-telephone">Passport
                                                Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="passport_number" value=""
                                                    placeholder="Passport Number" id="input-passport"
                                                    class="form-control">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row d-flex col-lg-12">
                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-bin">BIN</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="bin_num" value=""
                                                    placeholder="Enter Your BIN Number" id="input-bin-number"
                                                    class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-tin">TIN</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="tin_num" value=""
                                                    placeholder="Enter Your TIN Number" id="input-tin-number"
                                                    class="form-control" required="">
                                            </div>
                                        </div>
                                    </div>


                                </fieldset>


                                <fieldset>
                                    <legend>Your Password</legend>
                                    <div class="row d-flex col-lg-12">

                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-password">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password" value=""
                                                    placeholder="Password" id="input-password" class="form-control"
                                                    data-placement="bottom" data-toggle="popover" data-container="body"
                                                    data-html="true"
                                                    required="">


                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-confirm">Password
                                                Confirm</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="confirm" value=""
                                                    placeholder="Password Confirm" id="input-confirm"
                                                    class="form-control" required="">
                                            </div>
                                        </div>



                                    </div>
                                </fieldset>

                                <fieldset id="address">
                                    <legend>Your Address</legend>
                                    <div class="row d-flex col-lg-12">


                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-city">City</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="city" value="" placeholder="City"
                                                    id="input-city" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group required">
                                            <label class="col-sm-3 control-label" for="input-postcode">Post Code</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="postcode" value=""
                                                    placeholder="Post Code" id="input-postcode" class="form-control"
                                                    required="">
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>


                                <div class="buttons" style="padding: 60px 0;">
                                    <div class="pull-right">I have read and agree to all the <a href="#"
                                            class="agree"><b>Smart
                                                Terms &amp; Conditionss</b></a>
                                        <input class="box-checkbox" type="checkbox" name="agree" value="1"
                                            required=""> &nbsp;
                                        <input type="submit" value="Continue" id="submit_button"
                                            class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
