@extends('frontend.main_master')

@section('content')

<div class="body-content">

<div class="container">
    <div class="row">
       @include('frontend.common.user_sidebar')

        <div class="col-md-2">

        </div>

        <div class="col-md-6 mt-5 mt-md-0">
            <div class="card">
                <h3 class="text-center">
                    <span class="text-danger"> Change Password
                        <strong></strong>
                    </span>
                  
                </h3>
            </div>

            <div class="card-body">
                <form  method="POST" action="{{ route('user.update.password') }}">
                @csrf
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Current Password <span>*</span></label>
                        <input type="password" id="current_password" name="oldpassword" class="form-control">
                        @error('current password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">New Password<span>*</span></label>
                        <input type="password" id="password" name="password"  class="form-control">
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Confirmation Password<span>*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation"  class="form-control">
                    </div>


                    <div class="form-group">
                      <button type="submit" class="btn btn-danger">Update</button>
                    </div>

                </form>
            </div>




        </div>




    </div>
</div>
</div>

@endsection()