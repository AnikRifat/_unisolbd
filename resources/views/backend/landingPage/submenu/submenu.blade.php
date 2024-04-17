@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h5 class="box-title">SubMenu List</h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>Submenu</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($submenus as $item)
                                            <tr>
                                                <td>{{ $item->parent_name }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-center">
                                                    @if ($item->status == 1)
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a onclick="btnEditSubmenu({{ $item->id }})"
                                                        class="btn btn-sm btn-info editMenu mr-7"
                                                        href="javascript:void(0)"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    @if ($item->status == 1)
                                                        <a onclick="btnInactiveSubmenu({{ $item->id }})"
                                                            class="btn btn-sm btn-success" href="javascript:void(0)"><i
                                                                class="fa fa-arrow-down"></i></a>
                                                    @else
                                                        <a onclick="btnActiveSubmenu({{ $item->id }})"
                                                            class="btn btn-sm btn-danger" href="javascript:void(0)"><i
                                                                class="fa fa-arrow-up"></i></a>
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



                <div class="col-md-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h5 class="box-title">Add Submenu</h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            {{-- <form method="POST" action="{{ route('submenu.store') }}">
                                    @csrf --}}

                            <div class="form-group">
                                <label>Menu</label>
                                <div class="controls">
                                    <select id="menu_id" name="menu_id" class="form-control select2">
                                        @foreach ($menus as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('menu')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Name<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control form-control-sm">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title">Link</label>
                                <textarea type="text" id="link" name="link" class="form-control form-control-sm"> </textarea>
                            </div>

                            <div class="form-group">
                                <a type="button" id="btnAddSubmenu" onclick="btnSaveSubmenu()"
                                    class="btn btn-sm btn-primary">save</a>

                                <a type='button' id='btnClearSubmenu' onclick="btnClearSubmenu()"
                                    class="btn btn-sm btn-primary">reset</a>
                            </div>




                            {{-- </form> --}}


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
        var updatedId;

        var menu_id = $("#menu_id");
        var submenu = $("#name");
        var link = $("#link");

        function btnSaveSubmenu() {

            let obj = {
                parent_id: menu_id.val(),
                name: submenu.val(),
                link: link.val(),
            }
            console.log(obj)
            // if (checkEmptyCategoryInput()) {

            $.ajax({
                type: "POST",
                url: "{{ route('submenu.store') }}",
                data: obj,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    showToastr(response.type, response.message)
                    getSubmenuData();
                    btnClearSubmenu();


                },
                error: function(xhr, textStatus, errorThrown) {
                    toastr.error(xhr.responseText);
                }
            });

            // }
        }

        function btnEditSubmenu(id) {
            console.log(id)
            $.ajax({
                type: "get",
                url: `/landing-page/submenu/${id}/edit`,
                dataType: "json",
                success: function(response) {

                    updatedId = response.id;

                    console.log(response.id);
                    submenu.val(response.name);
                    link.val(response.link);
                    $('#menu_id').val(response.parent_id).trigger('change')


                    $('#btnAddSubmenu').remove();

                    if ($('#btnUpdateSubmenu').length === 0) {
                        $('#btnClearSubmenu').before(
                            '<a onclick="btnUpdateSubmenu()" id="btnUpdateSubmenu" class="btn btn-sm btn-success mr-1">Update</a>'
                        );
                    }

                }
            });
        }

        function getSubmenuData() {
            $.ajax({
                type: "get",
                url: "{{ route('submenu.index') }}",
                dataType: "JSON",
                success: function(response) {
                    var dataTable = $('#example1').DataTable();
                    dataTable.clear().draw();
                    response.forEach(function(submenu) {
                        var row = $("<tr>");
                        row.append(`
                              <td>${submenu.parent_name}</td>
                              <td>${submenu.name}</td>
                              <td>
                              <span class="badge badge-${submenu.status == 1 ? 'success' : 'danger'}">
                                  ${submenu.status == 1 ? 'Active' : 'Inactive'}
                              </span>
                              </td>
                              <td class="text-center ">
                                  <a onclick="btnEditSubmenu(${submenu.id })"   class="btn btn-sm btn-info editMenu mr-7" href="javascript:void(0)"
                                                        ><i class="fa-solid fa-pen-to-square"></i></a>
                                  ${submenu.status == 1 ?
                                  `<a onclick="btnInactiveSubmenu(${submenu.id })"  class="btn btn-sm btn-success" href="javascript:void(0)"><i
                                                                        class="fa fa-arrow-down"></i></a>`
                                  :
                                  `<a onclick="btnActiveSubmenu(${submenu.id })"  class="btn btn-sm btn-danger" href="javascript:void(0)"><i
                                                                        class="fa fa-arrow-up"></i></a>`
                                  }
                              </td>
                          `);
                        dataTable.row.add(row).draw(false);
                    });

                }
            });
        }

        function btnUpdateSubmenu() {

            let obj = {
                parent_id: menu_id.val(),
                name: submenu.val(),
                link: link.val(),
            }

            console.log(updatedId);

            // if (checkEmptyCategoryName()) {
            $.ajax({
                type: "put",
                url: "{{ route('submenu.update', '') }}" + "/" + updatedId,
                data: obj,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    getSubmenuData();
                    btnClearSubmenu();
                    showToastr(response.type, response.message)
                },
                error: function(xhr, textStatus, errorThrown) {
                    toastr.error(xhr.responseText);
                }
            });
            // }
        }

        function checkEmptyCategoryInput() {
            var category_name = $("#category_name").val().trim();
            var category_icon = $('#category_icon')[0].files;

            $(".errorMessage").remove(); // Remove any existing error messages

            var isError = false;

            if (category_name === '') {
                var errorMessage = $("<div class='errorMessage'>").addClass("text-danger").text(
                    "Category name cannot be empty");
                $("#category_name").after(errorMessage);
                $("#category_name").addClass("danger");
                isError = true;
            } else {
                $("#category_name").removeClass("danger");
            }

            if (category_icon.length === 0) {
                var errorMessage = $("<div class='errorMessage'>").addClass("text-danger").text(
                    "Category icon cannot be empty");
                $("#category_icon").after(errorMessage);
                $("#category_icon").addClass("danger");
                isError = true;
            } else {
                $("#category_icon").removeClass("danger");
            }

            return !isError;
        }

        function checkEmptyCategoryName() {
            var category_name = $("#category_name").val().trim();
            $(".errorMessage").remove(); // Remove any existing error messages

            var isError = false;

            if (category_name === '') {
                var errorMessage = $("<div class='errorMessage'>").addClass("text-danger").text(
                    "Category name cannot be empty");
                $("#category_name").after(errorMessage);
                $("#category_name").addClass("danger");
                isError = true;
            } else {
                $("#category_name").removeClass("danger");
            }
            return !isError;
        }

        function btnClearSubmenu() {
            $('#btnUpdateSubmenu').remove();

            if ($('#btnAddSubmenu').length === 0) {
                $('#btnClearSubmenu').before(
                    '<button id="btnAddSubmenu" onclick="btnSaveSubmenu()" class="btn btn-sm btn-success mr-1">Save</button>'
                    );
            }

            $("#name").val('');
            $("#link").val('');
        }

        function btnActiveSubmenu(id) {
            console.log(id);

            $.ajax({
                type: "POST",
                url: "{{ route('active.submenu', '') }}" + "/" + id,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    showToastr(response.type, response.message)
                    getSubmenuData();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        function btnInactiveSubmenu(id) {
            console.log(id);

            $.ajax({
                type: "POST",
                url: "{{ route('inactive.submenu', '') }}" + "/" + id,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    showToastr(response.type, response.message)
                    getSubmenuData();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
