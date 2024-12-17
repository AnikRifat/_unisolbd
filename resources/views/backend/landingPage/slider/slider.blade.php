@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Slider List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Slider Image</th>
                                            <th>Title </th>
                                            <th>Discription</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($slider as $item)
                                            <tr>
                                                <td><img src="{{ asset($item->slider_img) }}" alt=""
                                                        style="width:70px; height:40px"> </td>
                                                <td>
                                                    @if ($item->title == null)
                                                        <span class="badge badge-fills badge-danger">No Title</span>
                                                    @else
                                                        {{ $item->title }}
                                                    @endif
                                                </td>
                                                <td>{{ $item->description }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-center ">
                                                    <a data-edit-slider="{{ base64_encode($item) }}"
                                                        class="btn btn-sm btn-info editSlider mr-10"
                                                        href="javascript:void(0)"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    @if ($item->status == 1)
                                                        <form method="POST"
                                                            action="{{ route('landing-page-slider.inactive', $item->id) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-success"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-down"></i></button>
                                                        </form>
                                                    @else
                                                        <form method="POST"
                                                            action="{{ route('landing-page-slider.active', $item->id) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-up"></i></button>
                                                        </form>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>



                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Slider</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form id="sliderForm" method="POST" action="{{ route('landing-page-slider.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Title</label>
                                        <input type="text" name="title" class="form-control form-control-sm">
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Description</label>
                                        <textarea type="text" name="description" class="form-control form-control-sm"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Slider Image<span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="slider_img" id="slider_img" onchange="mainThamUrl(this)"
                                            class="form-control form-control-sm">
                                        @error('slider_img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button id="btnSave" type="submit" class="btn  btn-sm btn-success">Save</button>
                                        <a id="btnClear" class="btn  btn-sm btn-primary">Clear</a>
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




    <script>
        $(document).ready(function() {
            $('.editSlider').click(function() {
                var base64EncodedValue = $(this).data('edit-slider');
                var sliderData = JSON.parse(atob(base64EncodedValue));

                console.log(sliderData.id)
                $('#mainThmb').remove();
                $("input[name='title']").val(sliderData.title);
                $("textarea[name='description']").val(sliderData.description);
                var imgElement = $('<img>').attr({
                    'src': "/" + sliderData.slider_img,
                    'alt': '',
                    'id': 'mainThmb',
                    'height': '60px',
                    'width': '60px',

                });
                $('#slider_img').after(imgElement);
                $('#btnSave').remove();

                console.log(sliderData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#sliderForm').attr('action',
                    "{{ route('landing-page-slider.update', ['landing_page_slider' => ':id']) }}"
                    .replace(
                        ':id', sliderData.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();
            $('#mainThmb').remove();
            $("input[name='slider_img']").val('');

            $("input[name='title']").val('');
            $("textarea[name='description']").val('');

            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#sliderForm').attr('action', "{{ route('landing-page-slider.store') }}");

            // Change the method override field value to PUT
            $("input[name='_method']").val('POST');

        });
    </script>


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
                    $('#slider_img').after(imgElement);
                    $('#slider_img').closest('.form-group').find('.errorMessage.text-danger').remove();
                    $('#slider_img').removeClass('danger');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
