@extends('admin.admin_master')
@section('admin')

    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <!-- Date range -->
            <div class="form-group">
                <label>Date range:</label>

                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="reservation">
        
                            <button id="previewButton" class="btn btn-success">preview</button>
                        </div>
                    </div>
                </div>
                
                <!-- /.input group -->
            </div>
            <!-- /.form group -->
        
        </section>
    </div>



    <script>
        $(document).ready(function() {
            // Attach a click event handler to the preview button
            $('#previewButton').click(function() {
                // Get the value of the selected date range
                var selectedDateRange = $('#reservation').val();
                // Split the selected date range into start and end dates
                var dateParts = selectedDateRange.split(' - ');
                var startDate = dateParts[0];
                var endDate = dateParts[1];

                // Log the start and end dates to the console
                console.log("Start date:", startDate);
                console.log("End date:", endDate);
              

             

                // Construct the URL for the new tab
                var previewUrl = "{{ route('preview.expense-report') }}?start_date=" + startDate +
                    "&end_date=" + endDate;

                // Open a new tab with the preview URL
                var newTab = window.open(previewUrl, '_blank');

                // Prevent the default form submission
                return false;

            });
        });
    </script>

@endsection
