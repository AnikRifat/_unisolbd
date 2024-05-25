@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Solutions List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>name</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($solutions as $item)
                                            <tr>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td><img src="{{ asset($item->image) }}" style="width:70px; height:40px"></td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-center">
                                                    <a data-edit-solution="{{ base64_encode($item) }}"
                                                        href="javascript:void(0)"
                                                        class="btn btn-sm btn-info editSolution mr-10"><i class="fa-solid fa-edit"></i></a>

                                                    @if ($item->status == 1)
                                                        <form method="POST" action="{{ route('inactive.solution', $item->id) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-arrow-down"></i></button>
                                                        </form>
                                                    @else
                                                        <form method="POST" action="{{ route('active.solution', $item->id) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-arrow-up"></i></button>
                                                        </form>
                                                    @endif

                                                    <form method="POST" action="{{ route('solution.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
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
                            <h3 class="box-title">Add Solution</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form id="solutionForm" method="POST" action="{{ route('solution.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="info-title" for="title">Title<span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control form-control-sm">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="name">name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control form-control-sm">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="short_description">Short Description<span class="text-danger">*</span></label>
                                    <input type="text" name="short_description" class="form-control form-control-sm">
                                    @error('short_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="description">Description<span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control form-control-sm"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="image">Image<span class="text-danger">*</span></label>
                                    <input type="file" id="image" name="image" class="form-control form-control-sm" onchange="mainThamUrl(this)">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button id="btnSave" type="submit" class="btn btn-sm btn-success">Save</button>
                                    <a id="btnClear" class="btn btn-sm btn-primary">Clear</a>
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
            $('.editSolution').click(function() {
                var base64EncodedValue = $(this).data('edit-solution');
                var data = JSON.parse(atob(base64EncodedValue));

                $('#mainThmb').remove();
                $("input[name='title']").val(data.title);
                $("input[name='name']").val(data.name);
                $("input[name='short_description']").val(data.short_description);
                $("textarea[name='description']").val(data.description);

                var imgElement = $('<img>').attr({
                    'src': "/" + data.image,
                    'alt': '',
                    'id': 'mainThmb',
                    'height': '60px',
                    'width': '60px',
                });
                $('#image').after(imgElement);

                $('#btnSave').remove();
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }

                $('#solutionForm').attr('action', "{{ route('solution.update', ['id' => ':id']) }}".replace(':id', data.id));
                $("input[name='_method']").val('PUT');
            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();
            $('#mainThmb').remove();
            $("input[name='title']").val('');
            $("input[name='name']").val('');
            $("input[name='short_description']").val('');
            $("textarea[name='description']").val('');
            $("input[name='image']").val('');

            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>'
                );
            }

            $('#solutionForm').attr('action', "{{ route('solution.store') }}");
            $('#solutionForm').attr('method', "");
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
                    $('#image').after(imgElement);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
