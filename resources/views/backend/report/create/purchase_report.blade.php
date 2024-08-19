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
                            <select class="form-control form-control-md" id="purchaseType" name="purchaseType">
                                <option value="1">Purchase</option>
                                <option value="2">Purchase Return</option>
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
                        <input type="text" class="form-control pull-right" id="reservation">

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
                var purchaseType = $('#purchaseType').val();

                // Split the selected date range into start and end dates
                var dateParts = selectedDateRange.split(' - ');
                var startDate = dateParts[0];
                var endDate = dateParts[1];

                // Log the start and end dates to the console
                console.log("Start date:", startDate);
                console.log("End date:", endDate);
                console.log("Purchase type:", purchaseType);

                // $.ajax({
                //     type: "get",
                //     url: "{{ route('preview.purchase-report') }}",
                //     data: {
                //         start_date: startDate,
                //         end_date: endDate,
                //         type: purchaseType,
                //     },
                //     dataType: "html",
                //     success: function(response) {
                //         var newTab = window.open('', '_blank');
                //         newTab.document.open();
                //         newTab.document.write(response);
                //         newTab.document.close();
                //     },
                //     error: function(xhr, status, error) {
                //         console.error(error);
                //     }
                // });


                // Construct the URL for the new tab
                var previewUrl = "{{ route('preview.purchase-report') }}?start_date=" + startDate +
                    "&end_date=" + endDate + "&type=" + purchaseType;

                // Open a new tab with the preview URL
                var newTab = window.open(previewUrl, '_blank');

                // Prevent the default form submission
                return false;

            });
        });
    </script>
@endsection
