@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('backend/js/pages/editor.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/ckeditor/ckeditor.js') }}"></script>

    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div>
                <div class="box-header with-border py-0">
                    <h4 class="box-title">About Us Form</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('about-us.store') }}" enctype="multipart/form-data" onsubmit="submitForm()">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image<span class="text-danger">*</span></label>
                                            <div class="controls">
                                                <input type="file" id="image" onchange="mainThamUrl(this)" name="image" class="form-control form-control-sm">
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description<span class="text-danger">*</span></label>
                                                    <div class="controls">
                                                        <textarea id="editor1" name="description" rows="10" cols="80">
                    
                                                            {!! $about->description!!}
                                                    </textarea>

                                                    @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <button id="addProductBtn" type="submit" class="btn btn-success btn-sm mb-5">Submit</button>
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


            <div class="row m-20">
                <div class="form-group">
                    <h4>About Us</h4>
                    <div class="controls">
                    <img src="{{ asset($about->image) }}" alt="" style="height: 200px; width:200px">
                    </div>
                    <div class="controls">
                        {!! $about->description !!}
                    </div>

                    </div>
            </div>



            </div>

           
        </section>
        <!-- /.content -->
    </div>


    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                $('#mainThmb').remove();
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgElement = $('<img>').attr({
                        'src': e.target.result,
                        'alt': '',
                        'id': 'mainThmb',
                        'height': '60px',
                        'width': '60px',

                    });
                    $('#image').after(imgElement);
                    $('#image').closest('.form-group').find('.errorMessage.text-danger').remove();
                    $('#image').removeClass('danger');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection