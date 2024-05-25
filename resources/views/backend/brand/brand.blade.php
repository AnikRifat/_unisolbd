@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Brands List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Brand</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brand as $item)
                                            <tr>
                                                <td>{{ $item->brand_name }}</td>
                                                <td><img src="{{ asset($item->brand_image) }}"
                                                        style="width:70px; height:40px"></td>

                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    @endif
                                                </td>

                                                <td class="d-flex justify-content-center">
                                                    <a data-edit-brand="{{ base64_encode($item) }}"
                                                        href="javascript:void(0)"
                                                        class="btn btn-sm btn-info editBrand mr-10"><i
                                                            class="fa-solid fa-edit"></i></a>
                                                    {{-- <a href="{{ route('brand.destroy', $item->id) }}"class="btn btn-sm btn-danger mr-10"
                                                        id="delete"><i class="fa-sharp fa-solid fa-trash"></i></a> --}}


                                                    @if ($item->status == 1)
                                                        <form method="POST"
                                                            action="{{ route('inactive.brand', $item->id) }}">
                                                            @csrf


                                                                    <button class="btn btn-sm btn-danger"
                                                                    href="javascript:void(0)"><i
                                                                        class="fa fa-arrow-up"></i></button>
                                                        </form>
                                                    @else
                                                        <form method="POST"
                                                            action="{{ route('active.brand', $item->id) }}">
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
                            <h3 class="box-title">Add Brand</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <form id="brandForm" method="POST" action="{{ route('brand.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <label class="info-title" for="brand_name">Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="brand_name" class="form-control form-control-sm">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label class="info-title" for="brand_image">Image<span
                                            class="text-danger">*</span></label>
                                    <input type="file" id="brand_image" name="brand_image"
                                        class="form-control form-control-sm" onchange="mainThamUrl(this)">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
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
            $('.editBrand').click(function() {
                var base64EncodedValue = $(this).data('edit-brand');
                var data = JSON.parse(atob(base64EncodedValue));

                console.log(data.id)
                $('#mainThmb').remove();
                $("input[name='brand_name']").val(data.brand_name);
                var imgElement = $('<img>').attr({
                    'src': "/" + data.brand_image,
                    'alt': '',
                    'id': 'mainThmb',
                    'height': '60px',
                    'width': '60px',

                });
                $('#brand_image').after(imgElement);
                $('#btnSave').remove();

                console.log(data);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#brandForm').attr('action',
                    "{{ route('brand.update', ['brand' => ':id']) }}"
                    .replace(
                        ':id', data.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();
            $('#mainThmb').remove();
            $("input[name='brand_image']").val('');

            $("input[name='brand_name']").val('');

            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#brandForm').attr('action', "{{ route('brand.store') }}");

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
                    $('#brand_image').after(imgElement);
                    $('#brand_image').closest('.form-group').find('.errorMessage.text-danger').remove();
                    $('#brand_image').removeClass('danger');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
