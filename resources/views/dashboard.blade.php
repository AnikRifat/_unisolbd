@extends('frontend.main_master')
@section('content')
    <script src="{{ asset('frontendassets/custom-js/dataTables.min.js') }}"></script>
    <script src="{{ asset('frontendassets/custom-js/bootstrap4.min.js') }}"></script>


    <style>
        .profile-tab-nav {
            min-width: 250px;
        }

        .img-circle img {
            height: 100px;
            width: 100px;
            border-radius: 100%;
            border: 5px solid #fff;
        }

        #logout {
            text-align: left;
        }

        .upload-img {
            position: relative;
        }

        .upload-img a {
            position: absolute;
            top: 10px;
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

        #example thead {
            background: linear-gradient(318deg, rgba(82,195,255,1) 36%, rgba(88,104,162,1) 75%);;
            color: #fff;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .ellipsis {
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>

    @php
        // Retrieve the order details in the controller and pass it to the view
        // $orderDetails = App\Models\Order::select('orders.*')
        //     ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        //     ->where('orders.user_id', Auth::user()->id)
        //     ->get();
        
        $orderDetails = App\Models\Order::with('orderItems')
            ->where('user_id', Auth::user()->id)
            ->get();
        
    @endphp
    <section class="py-5">
        <div class="container">
            <div class="bg-white shadow rounded-lg d-block">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-tab-nav border-right">
                            <div class="px-4">
                                <div class="img-circle text-center mb-3">
                                    <img src="{{ !empty(Auth::user()->profile_photo_path) ? asset('storage/' . Auth::user()->profile_photo_path) : asset('upload/no_image.png') }}"
                                        alt="Image" class="shadow">
                                </div>
                                <h5 class="text-center">{{ Auth::user()->name }}</h5>
                            </div>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link  active" id="account-tab" data-toggle="pill" href="#account"
                                    role="tab" aria-controls="account" aria-selected="true">
                                    <i class="fa fa-home text-center mr-1"></i>
                                    Account
                                </a>
                                <a class="nav-link" id="password-tab" data-toggle="pill" href="#passwordTabPane"
                                    role="tab" aria-controls="passwordTabPane" aria-selected="false">
                                    <i class="fa fa-key text-center mr-1"></i>
                                    Change Password
                                </a>
                                <a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab"
                                    aria-controls="security" aria-selected="false">
                                    <i class="fa fa-shopping-cart text-center mr-1"></i>
                                    Orders
                                </a>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button id="logout" href="javascript:void(0)" class="btn nav-link">
                                        <i class="fa fa-arrow-circle-down text-center mr-1"></i>
                                        Logout
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="account" role="tabpanel"
                                aria-labelledby="account-tab">
                                <form action="{{ route('user-profile-information.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <h3 class="mb-4">Account Settings</h3>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Name<span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="{{ Auth::user()->name }}"
                                                    class="form-control" placeholder="full name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Email<span class="text-danger">*</span></label>
                                                <input type="email" name="email" value="{{ Auth::user()->email }}"
                                                    class="form-control" placeholder="example@gmail.com">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Phone number<span class="text-danger">*</span></label>
                                                <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                                                    class="form-control" placeholder="+88">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Profile Picture</label>
                                                <input name="photo" type="file" class="form-control" id="inputFile">
                                            </div>
                                        </div>
                                    </div>




                                    <div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </div>

                                </form>
                            </div>



                            <div class="tab-pane fade" id="passwordTabPane" role="tabpanel" aria-labelledby="password-tab">


                                <h3 class="mb-4">Password Settings</h3>
                                <form id="password-update-form" action="{{ route('user-password.update') }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Old password<span class="text-danger">*</span></label>
                                                <input type="password" name="current_password" class="form-control"
                                                    placeholder="old password" id="current_password">
                                                <span class="text-danger error-message"
                                                    id="current_password_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>New password<span class="text-danger">*</span></label>
                                                <div class="input-icon">
                                                    <input type="password" name="password" class="form-control mb-1"
                                                        placeholder="new password" id="password">
                                                    <i class="fa fa-eye input-icon" id="toggle-password"></i>
                                                </div>
                                                <span class="text-danger error-message" id="password_error"></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Confirm password<span class="text-danger">*</span></label>
                                                <div class="input-icon">
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control mb-1" placeholder="confirm password"
                                                        id="password_confirmation">
                                                    <i class="fa fa-eye input-icon" id="toggle-password-confirmation"></i>
                                                </div>
                                                <span class="text-danger error-message"
                                                    id="password_confirmation_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" id="update-password-button"
                                            class="btn btn-primary">Update</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </div>
                                </form>

                            </div>


                            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">



                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered"
                                        style="min-width: 1000px">
                                        <thead>
                                            <tr>
                                                <th>#SL</th>
                                                <th>Product</th>
                                                <th>Rate & Qty</th>
                                                <th>Amount</th>
                                                <th style="width: 120px">Order Date & time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            {{-- <tr>
                                                <td><span class="badge badge-success p-2">1</span></td>
                                                <td class="font-weight-bold" style="width:200px"><img
                                                        src="http://127.0.0.1:8000/upload/no_image.png"
                                                        style="height:50px; width:50px; margin-right:10px"><a
                                                        class="text-blue" href="javascript:void(0)">jfsksdf jjojdofs
                                                        jodjoidsf jijofsad</a></td>
                                                <td>3000<span class="text-danger">*</span>1</td>
                                                <td class="text-danger">50,000</td>
                                                <td><span class="text-secondary">5,dec 2023,02;10am</span></td>
                                                <td><span class="badge badge-success p-2">pending</span></td>
                                                <td><a href="javascript:void(0)"><i class="fa fa-eye text-dark"></i></a>
                                                </td>
                                            </tr> --}}


                                            @php $itemCounter = 1; @endphp

                                            @foreach ($orderDetails as $order)
                                                
                                                @foreach ($order->orderItems as $item)
                                                    <tr>
                                                        <td><span
                                                                class="badge badge-dark p-2">{{ $itemCounter }}</span>
                                                        </td>
                                                        <td class="font-weight-bold"
                                                            style="max-width: 200px; overflow: hidden;">
                                                            <div style="display: flex; align-items: center;">
                                                                <img src="{{ asset($item->product->product_thambnail) }}"
                                                                    style="height: 50px; width: 50px; margin-right: 10px">
                                                                <a class="text-blue" href="javascript:void(0)">
                                                                    {{ $item->product->product_name }}
                                                                </a>
                                                            </div>
                                                        </td>

                                                        <td>{{ $item->price }}*{{ $item->qty }}</td>
                                                        <td class="text-danger">
                                                            {{ number_format($item->subtotal, 0, '.', ',') }}</td>
                                                        <td style="width: 120px"><span
                                                                class="text-secondary">{{ $order->created_at->format('d M Y, h:ia') }}</span>
                                                        </td>
                                                        @php
                                                            $statusBadges = [
                                                                'Pending' => 'badge-secondary',
                                                                'Confirmed' => 'badge-primary',
                                                                'Processing' => 'badge-info',
                                                                'Picked' => 'badge-dark',
                                                                'Shipped' => 'badge-warning',
                                                                'Delivered' => 'badge-success',
                                                                'Cancel' => 'badge-danger',
                                                            ];
                                                        @endphp

                                                        <td>
                                                            <span class="badge {{ $statusBadges[$order->status] }} p-2">{{ ucfirst($order->status) }}</span>
                                                        </td>
                                                        
                                                        <td><a href="javascript:void(0)"><i
                                                                    class="fa fa-eye text-dark"></i></a></td>
                                                    </tr>
                                                    @php $itemCounter++; @endphp
                                                @endforeach
                                            @endforeach




                                        </tbody>

                                    </table>
                                </div>





                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script>
        $(document).ready(function() {
            $("#inputFile").on("change", function() {
                var inputFiles = this.files;
                var file = inputFiles[0];

                var validImageTypes = ["image/jpeg", "image/png", "image/gif"];

                if (file) {
                    if (!validImageTypes.includes(file.type)) {
                        alert("Please select a valid image file (JPEG, PNG, GIF).");
                        // Clear input file selection
                        $("#inputFile").val("");
                        return;
                    }

                    var profileImg = $("#profileImg");
                    var removeButton = $("#removeButton");

                    if (!profileImg.length) {
                        var code = `
                            <div id="profileImg" class="img-circle mb-3 upload-img">
                                <img alt="Image" class="shadow">
                                <a id="removeButton" href="javascript:void(0)"><i class="fa fa-trash text-danger mr-1"></i></a>
                            </div>
                        `;

                        $('#inputFile').after(code);
                        profileImg = $("#profileImg");
                        removeButton = $("#removeButton");
                    }

                    var reader = new FileReader();
                    reader.readAsDataURL(file);

                    reader.onload = function(e) {
                        var imgSrc = e.target.result;
                        profileImg.find("img").attr("src", imgSrc);
                        profileImg.show();
                    };
                }
            });

            $(document).on("click", "#removeButton", function() {
                var profileImg = $("#profileImg");
                profileImg.find("img").attr("src", "{{ asset('frontend/user/img/user2.png') }}");
                profileImg.hide();
                // Clear input file selection if needed
                $("#inputFile").val("");
            });
        });
    </script>

    <script src="{{ asset('frontendassets/custom-js/password_validator.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#password-update-form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                const form = $(this);
                const formData = form.serialize();
                const url = form.attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        // Handle success response (if needed)
                        console.log(response);

                        // Display success message or update UI
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;

                            // Clear error messages with the 'error-message' class
                            $('.error-message').empty();

                            // Display the validation errors
                            if (errors.current_password) {
                                $('#current_password_error').text(errors.current_password[0]);
                            }
                            if (errors.password) {
                                $('#password_error').text(errors.password[0]);
                            }
                        }
                        // Handle the case of error if needed
                    }
                });
            });

            $('#cancel-button').click(function() {
                // Implement cancel logic here
            });
        });
    </script>


    <script>
        // password_validator.js

        function perform(form) {
            event.preventDefault(); // Prevent default form submission

            const formData = form.serialize();
            const url = form.attr('action');

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    // Handle success response (if needed)
                    console.log(response);
                    $('.error-message').empty();
                    showToastr(response.type, response.messsage);
                    // location.reload();
                    // Display success message or update UI
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;

                        // Clear error messages with the 'error-message' class
                        $('.error-message').empty();

                        // Display the validation errors
                        if (errors.current_password) {
                            $('#current_password_error').text(errors.current_password[0]);
                        }
                        if (errors.password) {
                            $('#password_error').text(errors.password[0]);
                        }
                    }
                    // Handle the case of error if needed
                }
            });
        }
    </script>

    <script>
        new DataTable('#example');
    </script>
@endsection
