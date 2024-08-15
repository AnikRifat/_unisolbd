@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="box-header with-border">
                    <h3 class="box-title">User Details</h3>
                </div>
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            @foreach ([
                                'Name' => $user->name,
                                'Company Name' => $user->userDetails?->company_name,
                                'Trade License Number' => $user->userDetails?->trade_license_number,
                                'NID Number' => $user->userDetails?->nid_no,
                                'Passport Number' => $user->userDetails?->passport_number,
                                'BIN Number' => $user->userDetails?->bin_num,
                                'TIN Number' => $user->userDetails?->tin_num,
                                'Address' => $user->userDetails?->address,
                                'City' => $user->userDetails?->city,
                                'Post Code' => $user->userDetails?->post_code,
                                'Country' => $user->userDetails?->country,
                                'Phone' => $user->phone,
                                'Email' => $user->email
                            ] as $label => $value)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="info-title">{{ $label }}</label>
                                        <p class="form-control-static">{{ $value ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="info-title">NID Front Picture</label>
                                    @if($user->userDetails?->nid_front)
                                        <img src="{{ asset('storage/' . $user->userDetails->nid_front) }}" class="img-thumbnail" alt="NID Front Picture">
                                    @else
                                        <p class="form-control-static">No picture available</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="info-title">NID Back Picture</label>
                                    @if($user->userDetails?->nid_back)
                                        <img src="{{ asset('storage/' . $user->userDetails->nid_back) }}" class="img-thumbnail" alt="NID Back Picture">
                                    @else
                                        <p class="form-control-static">No picture available</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Conditional Button -->
                        @if($user->status == 3)
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <form method="POST" action="{{ route('user.active', $user->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Verify This User</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
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
