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
                                            <th>Subsubmenu</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subsubmenus as $item)
                                            <tr>
                                                <td>{{ $item->menu_name }}</td>
                                                <td>{{ $item->submenu_name }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-center">
                                                    @if ($item->status == 1)
                                                        <span class="badge bade-fills badge-success">Active</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a onclick="btnEdit({{ $item->id }})"
                                                        class="btn btn-sm btn-info editMenu mr-7"
                                                        href="javascript:void(0)"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    @if ($item->status == 1)
                                                        <a onclick="btnInactive({{ $item->id }})"
                                                            class="btn btn-sm btn-success" href="javascript:void(0)"><i
                                                                class="fa fa-arrow-down"></i></a>
                                                    @else
                                                        <a onclick="btnActive({{ $item->id }})"
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
                                <label>Submenu</label>
                                <div class="controls">
                                    <select id="submenu_id" name="submenu_id" class="form-control select2">
                                       
                                    </select>
                                    @error('submenu_id')
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

                                <a type='button' id='btnClear' onclick="btnClear()"
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

        var submenu_id = $("#submenu_id");
        var subsubmenu = $("#name");
        var link = $("#link");

        function btnSaveSubmenu() {

            let obj = {
                parent_id: submenu_id.val(),
                name: subsubmenu.val(),
                link: link.val(),
            }
            console.log(obj)
            // if (checkEmptyCategoryInput()) {

            $.ajax({
                type: "POST",
                url: "{{ route('subsubmenu.store') }}",
                data: obj,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    showToastr(response.type, response.message)
                    getSubmenuData();
                    btnClear();


                },
                error: function(xhr, textStatus, errorThrown) {
                    toastr.error(xhr.responseText);
                }
            });

            // }
        }

        function btnEdit(id) {
            console.log(id)
            $.ajax({
                type: "get",
                url: `/landing-page/subsubmenu/${id}/edit`,
                dataType: "json",
                success: function(response) {

                    updatedId = response.id;
                    console.log(response);
                   
                    subsubmenu.val(response.name);
                    link.val(response.link);
                    $('#menu_id').val(response.menu_id).trigger('change')
                    $('#submenu_id').val(response.submenu_id).trigger('change')


                    $('#btnAddSubmenu').remove();

                    if ($('#btnUpdate').length === 0) {
                        $('#btnClear').before(
                            '<a onclick="btnUpdate()" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</a>'
                        );
                    }

                }
            });
        }

        function getSubmenuData() {
            $.ajax({
                type: "get",
                url: "{{ route('subsubmenu.index') }}",
                dataType: "JSON",
                success: function(response) {
                    var dataTable = $('#example1').DataTable();
                    dataTable.clear().draw();
                    response.forEach(function(data) {
                        var row = $("<tr>");
                        row.append(`
                              <td>${data.menu_name}</td>
                              <td>${data.submenu_name}</td>
                              <td>${data.name}</td>
                              <td>
                              <span class="badge badge-${data.status == 1 ? 'success' : 'danger'}">
                                  ${data.status == 1 ? 'Active' : 'Inactive'}
                              </span>
                              </td>
                              <td class="text-center ">
                                  <a onclick="btnEdit(${data.id })"   class="btn btn-sm btn-info editMenu mr-7" href="javascript:void(0)"
                                                        ><i class="fa-solid fa-pen-to-square"></i></a>
                                  ${data.status == 1 ?
                                  `<a onclick="btnInactive(${data.id })"  class="btn btn-sm btn-success" href="javascript:void(0)"><i
                                                                                    class="fa fa-arrow-down"></i></a>`
                                  :
                                  `<a onclick="btnActive(${data.id })"  class="btn btn-sm btn-danger" href="javascript:void(0)"><i
                                                                                    class="fa fa-arrow-up"></i></a>`
                                  }
                              </td>
                          `);
                        dataTable.row.add(row).draw(false);
                    });

                }
            });
        }

        function btnUpdate() {

            let obj = {
                parent_id: submenu_id.val(),
                name: subsubmenu.val(),
                link: link.val(),
            }

            console.log(updatedId);

            // if (checkEmptyCategoryName()) {
            $.ajax({
                type: "put",
                url: "{{ route('subsubmenu.update', '') }}" + "/" + updatedId,
                data: obj,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    getSubmenuData();
                    btnClear();
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

        function btnClear() {
            $('#btnUpdate').remove();

            if ($('#btnAddSubmenu').length === 0) {
                $('#btnClear').before(
                    '<button id="btnAddSubmenu" onclick="btnSaveSubmenu()" class="btn btn-sm btn-success mr-1">Save</button>'
                );
            }

            $("#name").val('');
            $("#link").val('');
        }

        function btnActive(id) {
            console.log(id);

            $.ajax({
                type: "POST",
                url: "{{ route('active.subsubmenu', '') }}" + "/" + id,
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

        function btnInactive(id) {
            console.log(id);

            $.ajax({
                type: "POST",
                url: "{{ route('inactive.subsubmenu', '') }}" + "/" + id,
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

    <script>
        $(document).ready(function() {
            getSubmenu();
        });

        function getSubmenu() {
            menu_id = $('#menu_id').val();
            console.log(menu_id);
            $.ajax({
                type: "get",
                url: "{{ route('get-landing-page-menu') }}",
                data: {
                    id: menu_id
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('#submenu_id').empty();

                    // Loop through the response array and create options
                    $.each(response, function(index, item) {
                        $('#submenu_id').append('<option value="' + item.id + '">'+ item.name +'</option>');
                    });

                }
            });
        }



        $(document).ready(function() {
            $('#menu_id').change(function() {
                console.log("Menu ID changed"); // Add this line
                getSubmenu();
            });
        });
    </script>
@endsection
