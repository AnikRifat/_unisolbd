<?php $__env->startSection('admin'); ?>
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Quotation List</h3>
                        </div>

                        <div class="row px-40">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Type</label>
                                    <div class="controls">
                                        <select class="form-control form-control-md" id="type" name="type">
                                            <option value="0" selected>All</option>
                                            <option value="Online">Online</option>
                                            <option value="Offline">Offline</option>
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
                                            <th>Channel</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $quotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($index + 1); ?></td>
                                                <td><?php echo e($item->created_at->format('j F Y')); ?></td>
                                                <td><?php echo e($item->channel); ?></td>
                                                <td><?php echo e($item->vendor->name); ?></td>
                                                <td><?php echo e($item->vendor->phone); ?></td>
                                                <td class="text-center">
                                                    <?php if($item->status == 'quotation'): ?>
                                                        <span
                                                            class="badge badge-pill badge-success rounded-0"><?php echo e($item->status); ?></span>
                                                    <?php else: ?>
                                                        <span
                                                            class="badge badge-pill badge-danger rounded-0"><?php echo e($item->status); ?></span>
                                                    <?php endif; ?>

                                                </td>
                                                <td class="d-flex" style="width:80px">
                                                    <a data-print="<?php echo e($item->id); ?>"
                                                        class="btn btn-sm btn-primary btnPrint mr-10" data-toggle="tooltip" data-placement="top" title="Print Quotation"
                                                        href="javascript:void(0)"><i class="fa fa-print"></i></a>

                                                   


                                                    <?php if($item->status == 'quotation'): ?>
                                                    <a data-edit="<?php echo e($item->id); ?>"
                                                        class="btn btn-sm btn-success btnEdit mr-10" data-toggle="tooltip" data-placement="top" title="Edit Quotation"
                                                        href="<?php echo e(route('quotation-edit-or-invoice', ['id' => $item->id, 'type' => 'edit'])); ?>"><i
                                                            class="fa fa-edit"></i></a>
                                                            
                                                        <a data-edit="<?php echo e($item->id); ?>"
                                                            class="btn btn-sm btn-info btnSale mr-10" data-toggle="tooltip" data-placement="top" title="Make Invoice"
                                                            href="<?php echo e(route('quotation-edit-or-invoice', ['id' => $item->id, 'type' => 'invoice'])); ?>"><i
                                                                class="si-basket-loaded si"></i></a>
                                                    <?php endif; ?>






                                                </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        $(document).ready(function() {
            // Delegate the click event to a container element that exists from the start
            $(document).on("click", ".btnPrint", function() {
                var id = $(this).data("print");

                if (id) {
                    var newTabUrl =
                        "<?php echo e(route('preview.quotation-or-invoice.report', ['type' => 'quotation', 'id' => '__id__'])); ?>";
                    newTabUrl = newTabUrl.replace('__id__', id);
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
                var type = $('#type').val();

                // Split the selected date range into start and end dates
                var dateParts = selectedDateRange.split(' - ');
                var startDate = dateParts[0];
                var endDate = dateParts[1];

                console.log("start date : ", startDate);
                console.log("start date : ", endDate);

                $.ajax({
                    method: "get",
                    url: "<?php echo e(route('search.quotation')); ?>",
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        type: type,
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
            response.forEach(function(data, index) {

                var row = $("<tr>");
                var encodedData = btoa(JSON.stringify(data)); // Encode the d
                var editUrl = "<?php echo e(route('quotation.edit', ':quotation')); ?>";
                editUrl = editUrl.replace(':quotation', data.id);

                row.append(`
                            <td>${index + 1}</td>
                            <td>${data.formatted_created_at}</td>
                            <td>${data.channel}</td>
                            <td>${data.vendor.name}</td>
                            <td>${data.vendor.email}</td>
                            <td>${data.vendor.phone}</td>
                            <td class="d-flex justify-content-center ">
                                    <a data-print="${ data.id }"
                                        class="btn btn-sm btn-dark btnPrint mr-10"
                                        href="javascript:void(0)"><i
                                            class="fa fa-print"></i></a>

                                <a data-edit="${ data.id }"
                                                class="btn btn-sm btn-success btnEdit"
                                                href="${editUrl}"><i
                                                    class="fa fa-edit"></i></a>
                            </td>  
                        `);
                dataTable.row.add(row).draw(false);
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/quotation/view_quotation.blade.php ENDPATH**/ ?>