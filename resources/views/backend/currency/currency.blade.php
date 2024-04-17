@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Currency List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Country</th>
                                            <th>Code</th>
                                            <th>Symbol</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currencies as $item)
                                            <tr>
                                                <td>{{ $item->country }}</td>
                                                <td>{{ $item->code }}</td>
                                                <td>{{ $item->symbol }}</td>
                                                <td>
                                                    @if ($item->status != null)
                                                        <span class="bedge bg-success rounded px-2 py-1">active</span>
                                                    @else
                                                        <span class="bedge bg-danger rounded px-2 py-1">inactive</span>
                                                    @endif
                                                </td>

                                                @if ($item->status == 0)
                                                    <td class="d-flex justify-content-center">
                                                        <a data-edit="{{ base64_encode($item) }}" href="javascript:void(0)"
                                                            class="btn btn-sm btn-info btnEdit mr-10"><i
                                                                class="fa-solid fa-edit"></i></a>
                                                        {{-- <a href="{{ route('brand.destroy', $item->id) }}"class="btn btn-sm btn-danger mr-10"
                                                    id="delete"><i class="fa-sharp fa-solid fa-trash"></i></a> --}}



                                                        <form method="POST"
                                                            action="{{ route('active.currency', $item->id) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-up"></i></button>
                                                        </form>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a data-edit="{{ base64_encode($item) }}" href="javascript:void(0)"
                                                            class="btn btn-sm btn-info btnEdit ml-20"><i
                                                                class="fa-solid fa-edit"></i></a>
                                                    </td>
                                                @endif

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
                            <h3 class="box-title">Add Currency</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form id="currencyForm" method="POST" action="{{ route('currency.store') }}">
                                    @csrf
                                    @method('post')
                                    <div class="form-group">
                                        <label class="info-title" for="country">Country<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="country" class="form-control form-control-sm">
                                        @error('country')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title" for="currency">Currency<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="currency" class="form-control form-control-sm">
                                        @error('currency')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title" for="code">Code<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="code" class="form-control form-control-sm">
                                        @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="info-title" for="symbol">Symbol<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="symbol" class="form-control form-control-sm">
                                        @error('symbol')
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
            $('.btnEdit').click(function() {
                var base64EncodedValue = $(this).data('edit');
                var editData = JSON.parse(atob(base64EncodedValue));

                console.log(editData.id)

                $("input[name='country']").val(editData.country);
                $("input[name='currency']").val(editData.currency);
                $("input[name='code']").val(editData.code);
                $("input[name='symbol']").val(editData.symbol);

                $('#btnSave').remove();

                console.log(editData);
                if ($('#btnUpdate').length === 0) {
                    $('#btnClear').before(
                        '<button type="submit" id="btnUpdate" class="btn btn-sm btn-success mr-1">Update</button>'
                    );
                }
                // Set the form action dynamically
                $('#currencyForm').attr('action', "{{ route('currency.update', ['currency' => ':id']) }}"
                    .replace(
                        ':id', editData.id));

                // Change the method override field value to PUT
                $("input[name='_method']").val('PUT');

            });
        });

        $('#btnClear').click(function() {
            $('#btnUpdate').remove();

            $("input[name='country']").val('');
            $("input[name='currency']").val('');
            $("input[name='code']").val('');
            $("input[name='symbol']").val('');


            if ($('#btnSave').length === 0) {
                $('#btnClear').before(
                    '<button type="submit" id="btnSave" class="btn btn-sm btn-success mr-1">Save</button>');
            }

            // Set the form action dynamically
            $('#currencyForm').attr('action', "{{ route('currency.store') }}");

            // Change the method override field value to PUT
            $("input[name='_method']").val('POST');

        });
    </script>
@endsection
