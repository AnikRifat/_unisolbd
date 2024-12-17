@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="col-md-3">
                    <div class="form-group">
                        <label>Type</label>
                        <div class="controls">
                            <select class="form-control form-control-md" id="saleType" name="saleType">
                                <option value="0" selected>All</option>
                                <option value="3">Sale</option>
                                <option value="4">Sale Return</option>
                            </select>
                        </div>
                    </div>
                </div>



                <div class="col-md-3">
                    <div class="form-group">
                        <label>Customer</label>
                        <div class="controls">
                            <select class="form-control form-control-md select2" id="customer_id" name="customer_id">
                                
                                <option value="">Choose Cutomer</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <label>Date</label>
                    <div class="input-group">

                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control form-control-sm pull-right" id="reservation">

                        <button id="previewButton" class="btn btn-sm btn-success">preview</button>
                    </div>
                </div>

            </div>

        </section>
    </div>

    <script>
        $(document).ready(function() {
            // Attach a click event handler to the preview button
            $('#previewButton').click(function() {
                // Get the value of the selected date range
                var selectedDateRange = $('#reservation').val();
                var customer_id = $('#customer_id').val();
                var saleType = $('#saleType').val();

                // Split the selected date range into start and end dates
                var dateParts = selectedDateRange.split(' - ');
                var startDate = dateParts[0];
                var endDate = dateParts[1];

                // Log the start and end dates to the console
                console.log("Start date:", startDate);
                console.log("End date:", endDate);
                console.log("Purchase type:", saleType);
                console.log("customer_id:", customer_id);

                // Construct the URL for the new tab
                var previewUrl = "{{ route('preview.customer-report') }}?start_date=" + startDate +
                    "&end_date=" + endDate + "&type=" + saleType + "&customer_id=" + customer_id;
                var newTab = window.open(previewUrl, '_blank');
                return false;

            });
        });
    </script>
@endsection
