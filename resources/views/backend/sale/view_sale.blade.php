@extends('admin.admin_master')
@section('admin')
    <style>
        .form-control.danger {
            border: 1px solid red;
        }

        #mainThmb {
            margin: 10px 0px;
            width: 60px;
            height: 60px;
        }

        .icon {
            height: 40px;
            width: 40px;
        }
    </style>
    <div class="container-full">
        <!-- Main content -->
        <section class="content pt-0">

           

            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Purchase List</h3>
                        </div>

                        <div class="row px-40">
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
                                            <th class="text-center">Invoice No</th>
                                            <th class="text-center">type</th>
                                            <th class="text-center">Customer Name</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales  as $index => $item)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ $item->sale_date }}</td>
                                                <td>{{ $item->invoice_no }}</td>
                                                <td class="text-center">
                                                    @if ($item->type == 3)
                                                        <span class="badge bade-fills badge-success">Sale</span>
                                                    @else
                                                        <span class="badge bade-fills badge-danger">Sale Return</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->vendor->name }}</td>
                                                <td>{{ $item->vendor->phone  }}</td>
                                                <td></td>
                                                <td class="d-flex justify-content-center ">
                                                    <a data-print="{{ $item->id }}"
                                                        class="btn btn-sm btn-primary btnPrint mr-10"
                                                        href="javascript:void(0)"><i
                                                            class="fa-solid fa-print"></i></a>
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

    <script>
        // Wait for the document to be ready
        $(document).ready(function() {
            // Add a click event handler to the btnPrint buttons
            $(document).on("click", ".btnPrint", function() {
                // Get the id from the data-print attribute of the clicked button
                var id = $(this).data("print");
                
                // Check if id is defined and not empty
                if (id) {
                    var newTabUrl = "{{ route('preview.quotation-or-invoice.report', ['type' => 'sale', 'id' => '__id__']) }}";
                    newTabUrl = newTabUrl.replace('__id__', id);
                    var saleReportWindow = window.open(newTabUrl, "_blank");
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
    </script>


    <script>
        $(document).ready(function() {
            // Attach a click event handler to the preview button
            $('#previewButton').click(function() {
                // Get the value of the selected date range
                var selectedDateRange = $('#reservation').val();
                var saleType = $('#saleType').val();

                // Split the selected date range into start and end dates
                var dateParts = selectedDateRange.split(' - ');
                var startDate = dateParts[0];
                var endDate = dateParts[1];

                console.log("start date : ", startDate);
                console.log("start date : ", endDate);
                console.log("saleType: ", saleType);

                $.ajax({
                    type: "get",
                    url: "{{ route('datewise-sale') }}",
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        type : saleType,
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
                            <td>${data.sale_date}</td>
                            <td>${data.invoice_no}</td>
                            <td class="text-center">${data.type==3? '<span class="badge bade-fills badge-success">Sale</span>':'<span class="badge bade-fills badge-danger">Sale Return</span>'}</td>
                            <td>${data.customer.name}</td>
                            <td>${data.customer.phone}</td>
                            <td></td>
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
