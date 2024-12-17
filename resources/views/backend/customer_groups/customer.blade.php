@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Assign Customers to {{ $customerGroup->name }}</h3>
                        </div>
                        <div class="box-body">
                            <form action="{{ route('customer-groups.assign-user', $customerGroup->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Select Customers</label>
                                    <div class="list-group">
                                        @foreach($users as $user)
                                            <div class="list-group-item text-light">
                                                <input type="checkbox" id="user_{{ $user->id }}" name="customers[]" value="{{ $user->id }}">
                                                <label for="user_{{ $user->id }}">{{ $user->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Assign Customers</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Customers Assigned to {{ $customerGroup->name }}</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customerGroup->customers as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <form action="{{ route('customer-groups.detach', ['group' => $customerGroup->id, 'user' => $user->id]) }}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
