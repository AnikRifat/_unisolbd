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
                     <h4 class="box-title">Admin Profile Edit</h4>
                      </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                     <div class="row">
                       <div class="col">
 <form  method="post" action="{{ route('admin.profile.store')}}"  enctype="multipart/form-data">
    @csrf
                             <div class="row">
                               <div class="col-12">			
        
        <input type="hidden" name="old_image" value="{{ $editData->email }}">
                                   
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h5>Admin Email <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="email" name="email" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $editData->email }}"> </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h5>Admin Username <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="name" class="form-control" value="{{ $editData->name }}" > </div>
                </div>
            </div>
        </div>
                                  
                      
        

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h5>Profile Image <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="file" name="profile_photo_path" class="form-control" id="image"> </div>
                </div>
            </div>

            <div class="col-md-6">
                <img id="showImage" src="{{ $editData->profile_photo_path!=NULL? url($editData->profile_photo_path):url('upload/no_image.jpg') }}" style="width:100px; height:100px;">
            </div>
        </div>
                                
                                   
                                 
                               <div class="text-xs-right">
                                   <button type="submit" class="btn btn-rounded btn-info">Update</button>
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