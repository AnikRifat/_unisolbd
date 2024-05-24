@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <!-- Customer Group List -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Customer Group List</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Rules</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($customerGroups->count()> 0)
                                        @foreach ($customerGroups as $group)
                                            <tr>
                                                <td>{{ $group->name }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach(json_decode($group->rules, true) as $key => $value)
                                                            <li>{{ $key }}: {{ $value }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ $group->status }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('customer-groups.assign', $group->id) }}"
                                                        class="btn btn-sm btn-info mr-1">assign</a>
                                                    <a href="{{ route('customer-groups.edit', $group->id) }}"
                                                        class="btn btn-sm btn-info mr-1"><i class="fa-solid fa-edit"></i></a>
                                                    <form action="{{ route('customer-groups.destroy', $group->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger mr-1"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <!-- Add Customer Group Form -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Customer Group</h3>
                        </div>
                        <div class="box-body">
                            <form id="groupForm" method="POST" action="{{ route('customer-groups.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="info-title">Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control form-control-sm">
                                </div>
                                <div class="form-group" id="rules-container">
                                    <label class="info-title">Rules<span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="rules[key][]" class="form-control form-control-sm" placeholder="Key">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="rules[value][]" class="form-control form-control-sm" placeholder="Value">
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-success btn-add-rule">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="info-title">Status<span class="text-danger">*</span></label>
                                    <input type="number" name="status" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    <button type="reset" class="btn btn-sm btn-primary">Clear</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JavaScript for dynamic rule inputs -->
    <script>
        $(document).ready(function () {
            // Add new rule input field
            $(document).on('click', '.btn-add-rule', function () {
                var ruleInput = `<div class="row mt-2">
                                    <div class="col">
                                        <input type="text" name="rules[key][]" class="form-control form-control-sm" placeholder="Key">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="rules[value][]" class="form-control form-control-sm" placeholder="Value">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-danger btn-remove-rule">-</button>
                                    </div>
                                </div>`;
                $('#rules-container').append(ruleInput);
            });

            // Remove rule input field
            $(document).on('click', '.btn-remove-rule', function () {
                $(this).closest('.row').remove();
            });
        });
    </script>
@endsection
