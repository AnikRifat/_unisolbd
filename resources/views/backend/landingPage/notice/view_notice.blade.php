@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Notice List</h3>
                            <a href="{{ route('notice.create') }}" class="btn btn-sm btn-dark float-right">Add Notice</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Content</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notices as $index => $item)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>
                                                  {!! $item->content !!}
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-center ">
                                                    <a class="btn btn-sm btn-info editSlider mr-10"
                                                        href="{{ route('notice.edit',$item->id) }}"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    @if ($item->status == 1)
                                                        <form method="POST"
                                                            action="{{ route('inactive.notice', $item->id) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-success"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-down"></i></button>
                                                        </form>
                                                    @else
                                                        <form method="POST"
                                                            action="{{ route('active.notice', $item->id) }}">
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
