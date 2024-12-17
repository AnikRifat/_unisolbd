@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Solutions List</h3>
                        </div>
                    <a href="{{ route('solution.create') }}" class="btn btn-sm btn-success">Create Solution</a>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($solutions as $solution)
                                            <tr>
                                                <td>{{ $solution->title }}</td>
                                                <td>{{ $solution->name }}</td>
                                                <td><img src="{{ asset($solution->image) }}" style="width:70px; height:40px"></td>
                                                <td>
                                                    @if ($solution->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('solution.edit', $solution->id) }}" class="btn btn-sm btn-info mr-10"><i class="fa-solid fa-edit"></i></a>
                                                    @if ($solution->status == 1)
                                                    <form method="POST"
                                                        action="{{ route('solution.inactive', $solution->id) }}">
                                                        @csrf


                                                                <button class="btn btn-sm btn-danger"
                                                                href="javascript:void(0)"><i
                                                                    class="fa fa-arrow-up"></i></button>
                                                    </form>
                                                @else
                                                    <form method="POST"
                                                        action="{{ route('solution.active', $solution->id) }}">
                                                        @csrf
                                                        <button class="btn btn-sm btn-success"
                                                        href="javascript:void(0)"><i
                                                            class="fa fa-arrow-down"></i></button>
                                                    </form>
                                                @endif

                                                    <form method="POST" action="{{ route('solution.destroy', $solution->id) }}">
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
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
