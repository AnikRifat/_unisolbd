@extends('admin.admin_master')

@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 

<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        
         <div class="col-6">
          <div class="box">
           <div class="box-header with-border">
             <h3 class="box-title">Edit State</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="table-responsive">
              <form  method="POST" action="{{ route('state.update',$state->id) }}">
                @csrf

                <div class="form-group">
                    <h5>Division Select <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="division_id"  class="form-control">
                            <option selected="true" disabled="disabled" value="">Select Division</option>
                            @foreach ($divisions as $division)
                            <option {{ $state->division_id==$division->id? 'Selected': ''}} value="{{ $division->id }}">{{ $division->division_name }}</option>
                            @endforeach
                        </select>
                        @error('division_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                    <h5>District Select <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="district_id"  class="form-control">
                            <option selected="true" disabled="disabled" value="">Select District</option>                
                            @foreach ($districts as $district)
                            <option {{ $state->district_id==$district->id? 'Selected': '' }} value="{{ $district->id }}">{{ $district->district_name }}</option>
                            @endforeach
                        </select>
                        @error('district_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                  <label class="info-title">State Name<span class="text-danger">*</span></label>
                  <input type="text"  name="state_name" value="{{ $state->state_name }}" class="form-control">
                  @error('state_name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
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
        $(document).ready(function(){
        $('select[name="division_id"]').on('change',function(){
        var district_id =$(this).val();
        if(district_id){
        $.ajax({
          type: "GET",
          url: "{{ url('/shipping/district/ajax') }}/"+district_id,
          dataType: "json",
          success: function (data) {
        
            var d=$('select[name="district_id"]').empty();
            $.each(data, function(key,value){
              $('select[name="district_id"]').append('<option value="'+value.id+'">'+ value.district_name +'</option>');
            }); 
          }
        });
        }
        
        else{
          alert('danger');
        }
        });
        }); 
    </script>

  @endsection

