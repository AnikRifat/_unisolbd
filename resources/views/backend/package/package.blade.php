@extends('admin.admin_master')

@section('admin')
    <style>
        input.error {
            border-color: red;
        }
    </style>


    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">package List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Package Name</th>
                                            <th>status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($packages as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                               
                                                <td class="d-flex justify-content-center ">
                                                    <a data-toggle="tooltip" title="Package Item" href="{{ route('package-item.edit',$item->id) }}" class="btn btn-primary btn-sm mr-10"><i
                                                        class="fa  fa-plus-square"></i></a>
                                                    
                                                    <a data-edit="{{ base64_encode($item) }}" data-toggle="tooltip" title="Edit Package"
                                                        class="btn btn-sm btn-info btnEdit mr-10"><i class="fa fa-edit"></i></a>

                                                    @if ($item->status == 1)
                                                    <form method="POST" action="{{ route('inactive.package',$item->id) }}">
                                                        @csrf
                                                        
                                                            <button data-toggle="tooltip" title="Inactive Package" class="btn btn-sm btn-danger mr-10" href="javascript:void(0)"><i
                                                                class="fa fa-arrow-up"></i></button>
                                                    </form>
                                                    @else
                                                    <form method="POST" action="{{ route('active.package',$item->id) }}">
                                                        @csrf
                                                        <button data-toggle="tooltip" title="Active Package" class="btn btn-sm btn-success mr-10" href="javascript:void(0)"><i
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
                            <h3 class="box-title">Add Package</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form id="packageForm" method="POST" action="{{ route('package.store') }}">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label class="info-title" for="name">Package Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="name" value="{{ old('name') }}" name="name" class="form-control form-control-sm">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button id="btnSave" type="submit" class="btn  btn-sm btn-success">Save</button>
                                    <a id="btnClear"  class="btn  btn-sm btn-primary">Clear</a>
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


    {{-- <script>
        var id;

        function btnSavePackage() {

            let package = {
                "name": $("#name").val().trim(),
            }

            console.log(checkEmptyPackageInput())
            if (checkEmptyPackageInput()) {

                $.ajax({
                    type: "POST",
                    url: "{{ route('package.store') }}",
                    data: package,
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                        if (response.message) {
                            toastr.success(response.message);
                        }
                        getPackageData();
                        btnClearPackage();
                    }
                });
            }
        }


        function btnEditPackage(e) {
            // e.preventDefault();

            // Get the data from the clicked row
            var getId = $(e).data('edit');

            var row = $(e).closest('tr');
            var name = row.find('td:eq(0)').text(); // Get the text content of the second <td> element

            $("#name").val(name);

            $('#btnUpdatePackage').show();
            $('#btnAddPackage').hide();

            id = getId;
            // Do something with the data
            console.log('ID:', getId);
            console.log('Name:', name);
        }



        function getPackageData() {

            $.ajax({
                type: "get",
                url: "{{ route('package.index') }}",
                dataType: "JSON",
                success: function(response) {
                    var dataTable = $('#example1').DataTable();
                    dataTable.clear().draw();
                    response.forEach(function(package) {
                        var row = $("<tr>");
                        row.append(`
                        
                            <td>${package.name}</td>
                            <td>
                            <span class="badge badge-${package.status == 1 ? 'success' : 'danger'}">
                                ${package.status == 1 ? 'Active' : 'Inactive'}
                            </span>
                            </td>
                            <td style="width:120px">
                                <a onclick="btnEditPackage(this)"  class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i></a>
                                ${package.status == 1 ?
                                `<a href="javascript:void(0)" onclick="btnInactivePackage(${package.id })"  class="btn btn-danger btn-sm" title=""><i class="fa fa-arrow-down"></i></a>`
                                :
                                `<a href="javascript:void(0)"  onclick="btnActivePackage(${package.id })"  class="btn btn-success btn-sm" title=""><i class="fa fa-arrow-up"></i></a>`
                                }
                            </td>
                        `);
                        dataTable.row.add(row).draw(false);
                    });

                }
            });
        }

        function btnUpdatePackage() {

            let package = {
                "name": $("#name").val().trim(),
                'id': id
            }

            var url = "{{ route('package.update', ['package' => ':package']) }}";
                url = url.replace(':package', id);

            console.log(checkEmptyPackageInput())
            if (checkEmptyPackageInput()) {
                $.ajax({
                    type: "PUT",
                    url: url,
                    data: package,
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                        if (response.message) {
                            toastr.success(response.message);
                        }
                        getPackageData();
                        btnClearPackage();
                    }
                });
            }
        }

        function checkEmptyPackageInput() {
            var name = $("#name").val().trim();
            if (name == '') {
                $(".errorMessage").remove();
                var errorMessage = $("<div class='errorMessage'>").addClass("text-danger").text(
                    "Package name cannot be empty");
                $("#name").closest(".form-group").append(errorMessage);
                $("#name").addClass("error");
                return false
            } else {
                $(".errorMessage").remove();
                $("#name").removeClass("error");
            }

            return true;
        }

        function btnClearPackage() {
            $(".errorMessage").empty();
            $("#name").removeClass("error");
            $("#name").val('');
            $('#btnUpdatePackage').hide();
            $('#btnAddPackage').show();

        }

        function btnActivePackage(id) {

          var url = "{{ route('active.package', ['id' => ':id']) }}";
                url = url.replace(':id', id);

            $.ajax({
                type: "POST",
                url: url,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    showToastr(response.type,response.message);
                    getPackageData();
                }
            });

        }


        function btnInactivePackage(id) {
          var url = "{{ route('inactive.package', ['id' => ':id']) }}";
                url = url.replace(':id', id);

            $.ajax({
                type: "POST",
                url: url,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    showToastr(response.type,response.message);
                    getPackageData();
                }
            });

        }
    </script> --}}


    <script>
        $(document).ready(function() {
            $('.btnEdit').click(function() {

                
                var base64EncodedValue = $(this).data('edit');

                 var editData = JSON.parse(atob(base64EncodedValue));

                 console.log(base64EncodedValue)

                $("input[name='name']").val(editData.name);
               

                $('#btnSave').remove();

                console.log(editData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#packageForm').attr('action', "{{ route('package.update', ['package' => ':id']) }}"
                    .replace(
                        ':id', editData.id));

                // Change the method override field value to PUT
                $("#packageForm input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();

            $("input[name='name']").val('');
    
            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#packageForm').attr('action', "{{ route('role.store') }}");

            // Change the method override field value to PUT
            $("#packageForm input[name='_method']").val('POST');

        });
    </script>
@endsection
