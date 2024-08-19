@extends('admin.admin_master')

@section('admin') 
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        
         <div class="col-12">
          <div class="box">
           <div class="box-header with-border">
             <h3 class="box-title">Update Social Media</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="table-responsive">
              <form  method="POST" action="{{ route('update_social_media.setting',$socialmedia->id) }}"  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">link<span class="text-danger">*</span></label>
                    <textarea type="text"  name="link"  class="form-control">{{ $socialmedia->link }} </textarea>
                    @error('link')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
    
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Icon<span class="text-danger">*</span></label>
                    <div class="card">
                      <img class="card-img-top" src="{{ asset($socialmedia->icon) }}" alt="Card image cap" 
                      style="width: 200px; height:100px">
                    </div>
                    <input type="file"  name="icon" onchange="mainThamUrl(this)"  class="form-control">
                    @error('icon')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
      
                    <br>
                    <img src="" id="slider" alt="">
                </div>

          <div class="form-group">
            <button type="submit" class="btn btn-rounded btn-primary">Update</button>
          </div>
            
              </form>

             </div>              
           </div>
           <!-- /.box-body -->
           </div>
           <!-- /.box -->          
         </div>


      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
  </div>





  <script type="text/javascript">
    function mainThamUrl(input)
    {
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#slider').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    </script>

@endsection