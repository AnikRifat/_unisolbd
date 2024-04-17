@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="box">
                    <div class="d-flex justify-content-between">
                        <div class="box-header with-border">
                            <h3 class="box-title">Expense List</h3>
                        </div>
                        <div class="box-header with-border">
                            <a href="{{ route('create.expense') }}" class="btn btn-sm btn-dark">Add Expense</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Date</th>
                                        <th>Expense of Purpose</th>
                                        <th>Amount</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $index => $expense)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ $expense->date }}</td>
                                                <td>{{ $expense->purpose }}</td>
                                                <td>{{ $expense->amount }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('edit.expense', $expense->id) }}"
                                                        class="btn btn-sm btn-info"><i class="fa-solid fa-pen"></i></a>
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
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection
