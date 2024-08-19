@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Social Media List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Icon</th>
                                            <th>Status</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($socialmedia as $item)
                                            <tr>
                                                <td><img src="{{ asset($item->icon) }}" alt=""
                                                        style="width:40px; height:40px"> </td>

                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                {{-- <td style="width:120px">
                                                    <a data-edit="{{ base64_encode($item) }}" href="javascript:void(0)"
                                                    class="btn btn-sm btn-info btnEdit"><i
                                                    class="fa fa-solid fa-edit"></i></a>
                                                    <a href=""class="btn btn-danger btn-sm" id="delete"><i
                                                            class="fa-sharp fa-solid fa-trash"></i></a>
                                                    @if ($item->status == 1)
                                                        <a href="" class="btn btn-danger btn-sm" title=""><i
                                                                class="fa fa-arrow-down"></i></a>
                                                    @else
                                                        <a href="" class="btn btn-success btn-sm" title=""><i
                                                                class="fa fa-arrow-up"></i></a>
                                                    @endif

                                                </td> --}}

                                                <td class="d-flex justify-content-center ">
                                                    <a data-edit="{{ base64_encode($item) }}"
                                                        class="btn btn-sm btn-info btnEdit mr-10"
                                                        href="javascript:void(0)"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    @if ($item->status == 1)
                                                        <form method="POST"
                                                            action="{{ route('inactive.social-media', $item->id) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-up"></i></button>
                                                           
                                                        </form>
                                                    @else
                                                        <form method="POST"
                                                            action="{{ route('active.social-media', $item->id) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-success"
                                                            href="javascript:void(0)"><i
                                                                class="fa fa-arrow-down"></i></button>
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



                <div class="col-lg-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Social Media</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <form id="socialMediaForm" method="POST" action="{{ route('social-media-setting.store') }}" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label class="info-title" for="link">link<span class="text-danger">*</span></label>
                                    <textarea type="text" name="link" class="form-control"> </textarea>
                                    @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="icon">Icon<span class="text-danger">*</span></label>
                                    <input type="file" id="icon" name="icon" onchange="mainThamUrl(this)" class="form-control">
                                    @error('icon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-2">
                                    <button id="btnSave" type="submit" class="btn  btn-sm btn-success">Save</button>
                                    <a id="btnClear" class="btn  btn-sm btn-primary">Clear</a>
                                </div>

                            </form>


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
            $('.btnEdit').click(function() {
                var base64EncodedValue = $(this).data('edit');
                var editData = JSON.parse(atob(base64EncodedValue));

                console.log(editData.id)

                $("textarea[name='link']").val(editData.link);
                $('#mainThmb').remove();

                var imgElement = $('<img>').attr({
                    'src': "/" + editData.icon,
                    'alt': '',
                    'id': 'mainThmb',
                    'height': '60px',
                    'width': '60px',

                });
                $('#icon').after(imgElement);
                $('#btnSave').remove();

                console.log(editData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#socialMediaForm').attr('action', "{{ route('social-media-setting.update', ['social_media_setting' => ':id']) }}"
                    .replace(
                        ':id', editData.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();
            $('#mainThmb').remove();
            $("input[name='icon']").val('');
            $("textarea[name='link']").val('');
           
            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#socialMediaForm').attr('action', "{{ route('social-media-setting.store') }}");

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
                    $('#icon').after(imgElement);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
