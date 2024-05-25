@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ isset($solution) ? 'Edit Solution' : 'Add Solution' }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form id="solutionForm" method="POST" action="{{ isset($solution) ? route('solution.update', ['solution' => $solution->id]) : route('solution.store') }}" enctype="multipart/form-data">
                                @csrf
                                @if(isset($solution))
                                    @method('PUT')
                                @endif
                                <div class="form-group">
                                    <label class="info-title" for="title">Title<span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control form-control-sm" value="{{ isset($solution) ? $solution->title : '' }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="name">Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control form-control-sm" value="{{ isset($solution) ? $solution->name : '' }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="short_description">Short Description<span class="text-danger">*</span></label>
                                    <input type="text" name="short_description" class="form-control form-control-sm" value="{{ isset($solution) ? $solution->short_description : '' }}">
                                    @error('short_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group ">
                                    <label class="info-title" for="description">Description<span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <textarea id="editor1" name="description" class="form-control form-control-sm" rows="10">{{ isset($solution) ? $solution->description : '' }}</textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="image">Image<span class="text-danger">*</span></label>
                                    <input type="file" id="image" name="image" class="form-control form-control-sm" onchange="mainThamUrl(this)">
                                    @if(isset($solution) && $solution->image)
                                        <img src="{{ asset($solution->image) }}" style="width: 100px; height: 100px;" alt="Solution Image">
                                    @endif
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button id="btnSave" type="submit" class="btn btn-sm btn-success">{{ isset($solution) ? 'Update' : 'Save' }}</button>
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

    <script src="{{ asset('backend/js/pages/editor.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#btnClear').click(function() {
                $('#solutionForm')[0].reset();
            });
        });

        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image').after('<img src="'+e.target.result+'" style="width: 100px; height: 100px;" alt="Solution Image">');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
