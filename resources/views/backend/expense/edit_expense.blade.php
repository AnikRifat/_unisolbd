@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="box-header with-border">
                    <h3 class="box-title">Vendor Edit</h3>
                </div>
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                            <form method="POST" action="{{ route('update.expense',$expense->id) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">Date of Expense<span class="text-danger">*</span></label>
                                            <input type="date" value="{{ $expense->date }}" placeholder="date" name="date" class="form-control form-control-sm">
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">Purpose of Expense<span class="text-danger">*</span></label>
                                            <textarea name="purpose" id="purpose" class="form-control form-control-sm" rows="1">{{ $expense->purpose }}</textarea>
                                            @error('purpose')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">Amount<span class="text-danger">*</span></label>
                                            <input type="text" name="amount" value="{{ $expense->amount }}" class="form-control">
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="info-title">Receipt</label>
                                            <input type="file" name="receipt" class="form-control">
                                           
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-6 mt-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                       
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
