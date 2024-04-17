@php
$user=DB::table('users')->find(Auth::id());
@endphp
<div class="col-md-2"><br>
    <div class="text-center" style="height: 40%; width:100%;">
 <img class="rounded-circle shadow-4-strong" style="height:150px; width:150px; text-align: center"  alt="avatar2" src="{{ (!empty($user->profile_photo_path))? url($user->profile_photo_path):url('upload/no_image.jpg') }} " />
    </div>
   
    {{-- <img class="card-img-top" style="border-radius: 50%" src="{{ (!empty($user->profile_photo_path))? url($user->profile_photo_path):url('upload/no_image.jpg') }}" height="150px" width="150px"><br><br> --}}


    <ul class="list-group list-group-flush">
        <a href="{{ route('dashboard') }}" class="btn-primary btn-sm btn-block text-center" >Home</a>
        <a href="{{ route('user.profile') }}" class="btn-primary btn-sm btn-block text-center" >Profile Update</a>
        <a href="{{ route('user.change.password') }}" class="btn-primary btn-sm btn-block text-center" >Change Password</a>
        <a href="{{ route('my.orders') }}" class="btn-primary btn-sm btn-block text-center" >Orders</a>
        <a  href="{{ route('return.oder.list') }}" class="btn-primary btn-sm btn-block text-center">Return Orders</a>
        <a  href="{{ route('cancel.orders') }}" class="btn-primary btn-sm btn-block text-center">Cancel Orders</a>
        <a  href="{{ route('user.logout') }}" class="btn-danger btn-sm btn-block text-center">Logout</a>
        
    </ul>
</div>