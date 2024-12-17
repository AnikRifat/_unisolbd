@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pending Quotation</h3>
                        </div>

                        <div class="row px-40">
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

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Date</th>
                                            <th>Quotation</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendingQuotation as $index => $item)

                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $item->created_at->format('j F Y') }}</td>
                                            <td>{{ $item->package->name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td> 
                                            <td class="d-flex justify-content-center ">
                                                <a data-print="{{ $item->id }}"
                                                    class="btn btn-sm btn-dark btnPrint mr-10"
                                                    href="javascript:void(0)"><i
                                                        class="fa fa-print"></i></a>
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


    {{-- <script>
        // Wait for the document to be ready
        $(document).ready(function() {
            // Add a click event handler to the btnPrint buttons
            $(".btnPrint").click(function() {
                // Get the id from the data-print attribute of the clicked button
                var id = $(this).data("print");
                
                // Check if id is defined and not empty
                if (id) {
                    // Specify the URL of the route you want to open
                    var newTabUrl = "{{ route('package.report') }}" + "?id=" + encodeURIComponent(id);
                    
                    // Open the new tab with the specified URL
                    var saleReportWindow = window.open(newTabUrl, "_blank");
                    
                    // Check if the new tab was opened successfully
                    if (saleReportWindow) {
                        // Focus on the new tab
                        saleReportWindow.focus();
                    } else {
                        // Handle the case where the browser's popup blocker prevented the new tab from opening
                        alert("Popup blocked. Please allow popups for this site.");
                    }
                }
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            // Delegate the click event to a container element that exists from the start
            $(document).on("click", ".btnPrint", function() {
                var id = $(this).data("print");
    
                if (id) {
                    var newTabUrl = "{{ route('package.report') }}" + "?id=" + encodeURIComponent(id);
                    var saleReportWindow = window.open(newTabUrl, "_blank");
    
                    if (saleReportWindow) {
                        saleReportWindow.focus();
                    } else {
                        alert("Popup blocked. Please allow popups for this site.");
                    }
                }
            });
        });
    </script>
    

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

                console.log("start date : ", startDate);
                console.log("start date : ", endDate);

                $.ajax({
                    type: "get",
                    url: "{{ route('datewise-pending-quotation') }}",
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                    },
                    dataType: "json",
                    success: function(response) {
                       console.log(response);
                       renderDatatable(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            });
        });


        function renderDatatable(response) {
                    var dataTable = $('#example1').DataTable();
                    dataTable.clear().draw();
                    response.forEach(function(data) {
                        var row = $("<tr>");
                        var encodedData = btoa(JSON.stringify(data)); // Encode the d
                        row.append(`
                            <td>1</td>
                            <td>${data.formatted_created_at}</td>
                            <td>${data.package.name}</td>
                            <td>${data.name}</td>
                            <td>${data.email}</td>
                            <td>${data.phone}</td>
                            <td class="d-flex justify-content-center ">
                                                <a data-print="${ data.id }"
                                                    class="btn btn-sm btn-dark btnPrint mr-10"
                                                    href="javascript:void(0)"><i
                                                        class="fa fa-print"></i></a>
                            </td>  
                        `);
                        dataTable.row.add(row).draw(false);
                    });
            }
    </script>
@endsection
