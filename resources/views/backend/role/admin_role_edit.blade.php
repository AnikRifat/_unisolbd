@extends('admin.admin_master')

@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container-full">

    <!-- Main content -->
    <section class="content">
            <section class="content">

                <!-- Basic Forms -->
                 <div class="box">
                   <div class="box-header with-border">
                     <h4 class="box-title">Edit Admin User</h4>
                     
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                     <div class="row">
                       <div class="col">
 <form method="POST" action="{{ route('admin.user.update',$adminuser->id) }}" enctype="multipart/form-data">
  @csrf
                             <div class="row">
                               <div class="col-12">						
        <input type="hidden" name="old_image" value="{{ $adminuser->profile_photo_path }}">               
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h5>Admin User Name <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="name" class="form-control" value="{{ $adminuser->name }}" > </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <h5>Admin Email <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="email" name="email" class="form-control" value="{{ $adminuser->email }}"> </div>
                </div>

            </div>
            
        </div>





        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h5>Admin User Phone <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="number" name="phone" class="form-control" value="{{ $adminuser->phone }}"> </div>
                </div>
            </div>

         
            
        </div>



                                  
                      
        

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h5>Admin User Image <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="file" name="profile_photo_path" class="form-control" id="image"> </div>
                </div>
            </div>

            <div class="col-md-6">
                <img  id="showImage" src="{{ $adminuser->profile_photo_path!=NULL? url($adminuser->profile_photo_path) : url('upload/no_image.jpg') }}" style="width:100px; height:100px;">
            </div>
        </div>


        <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <div class="controls">
                    <fieldset>
                        <input {{ $adminuser->brand==1? 'checked':"" }} type="checkbox" id="checkbox_1" name="brand"  value="1">
                        <label for="checkbox_1">Brand</label>
                    </fieldset>
                    <fieldset>
                        <input {{ $adminuser->category==1? 'checked':"" }} type="checkbox" id="checkbox_2" name="category" value="1">
                        <label for="checkbox_2">Category</label>
                    </fieldset>
                    <fieldset>
                        <input {{ $adminuser->product==1? 'checked':"" }} type="checkbox" id="checkbox_3" name="product" value="1">
                        <label for="checkbox_3">Product</label>
                    </fieldset>
                    <fieldset>
                        <input {{ $adminuser->slider==1? 'checked':"" }} type="checkbox" id="checkbox_4" name="slider" value="1">
                        <label for="checkbox_4">Slider</label>
                    </fieldset>
                    <fieldset>
                        <input {{ $adminuser->coupons==1? 'checked':"" }} type="checkbox" id="checkbox_5" name="coupons" value="1">
                        <label for="checkbox_5">Coupons</label>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="controls">
                    <fieldset>
                        <input {{ $adminuser->shipping==1? 'checked':"" }} type="checkbox" id="checkbox_6" name="shipping"  value="1">
                        <label for="checkbox_6">Shipping</label>
                    </fieldset>
                    <fieldset>
                        <input {{ $adminuser->blog==1? 'checked':"" }} type="checkbox" id="checkbox_7" name="blog" value="1">
                        <label for="checkbox_7">Blog</label>
                    </fieldset>
                    <fieldset>
                        <input {{ $adminuser->setting==1? 'checked':"" }} type="checkbox" id="checkbox_8" name="setting" value="1">
                        <label for="checkbox_8">Setting</label>
                    </fieldset>
                    <fieldset>
                        <input {{ $adminuser->returnorder==1? 'checked':"" }} type="checkbox" id="checkbox_9" name="returnorder" value="1">
                        <label for="checkbox_9">Return Order</label>
                    </fieldset>
                    <fieldset>
                        <input {{ $adminuser->review==1? 'checked':"" }} type="checkbox" id="checkbox_10" name="review" value="1">
                        <label for="checkbox_10">Review</label>
                    </fieldset>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <div class="controls">
                    <fieldset>
                        <input {{ $adminuser->orders==1? 'checked':"" }} type="checkbox" id="checkbox_11" name="orders"  value="1">
                        <label for="checkbox_11">Orders</label>
                    </fieldset>
                    <fieldset>
                        <input {{ $adminuser->stock==1? 'checked':"" }} type="checkbox" id="checkbox_12" name="stock" value="1">
                        <label for="checkbox_12">Stock</label>
                    </fieldset>
                    <fieldset>
                        <input {{ $adminuser->reports==1? 'checked':"" }} type="checkbox" id="checkbox_13" name="reports"  value="1">
                        <label for="checkbox_13">Reports</label>
                    </fieldset>
                    <fieldset>
                        <input {{ $adminuser->alluser==1? 'checked':"" }} type="checkbox" id="checkbox_14" name="alluser" value="1">
                        <label for="checkbox_14">All User</label>
                    </fieldset>
                    <fieldset>
                        <input {{ $adminuser->adminuserrole==1? 'checked':"" }} type="checkbox" id="checkbox_15" name="adminuserrole" value="1">
                        <label for="checkbox_15">Admin User Role</label>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
                                
                                   
                                 
                               <div class="text-xs-right">
                                   <button type="submit" class="btn btn-rounded btn-info">Update Admin User</button>
                               </div>
                           </form>
       
                       </div>
                       <!-- /.col -->
                     </div>
                     <!-- /.row -->
                   </div>
                   <!-- /.box-body -->
                 </div>
                 <!-- /.box -->
       
               </section>


    </section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader= new FileReader(); 
                reader.onload=function(e){
                    $('#showImage').attr('src',e.target.result);

                }
                reader.readAsDataURL(e.target.files['0']);
            
        });
    });
    </script>

  @endsection