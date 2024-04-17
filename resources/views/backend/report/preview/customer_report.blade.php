<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Customers Wise Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('backend/custom/assets/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('backend/custom/assets/fonts/font-awesome/css/font-awesome.min.css') }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('backend/custom/assets/css/style.css') }}">
</head>

<body>
    <!-- Invoice 1 start -->
    <div class="invoice-1 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner clearfix">
                        <div class="invoice-info clearfix" id="invoice-content">
                            <div class="row g-0 text-center">
                                <h3>{{ strtoupper($setting->company_name) }}</h3>
                                <p class="m-1">{{ $setting->company_address }}</p>
                                <p class="mb-3">{{ $setting->phone_one }}, {{ $setting->phone_two }}</p>
                                <h6>Customer Wise Sale Details For All Products For {{ \Carbon\Carbon::createFromFormat('m/d/Y', $startDate)->format('F j, Y') }} To {{ \Carbon\Carbon::createFromFormat('m/d/Y', $endDate)->format('F j, Y') }}</h6>
                            </div>

                            
                                <div class="row">
                                        <div class="m-3 mb-30">
                                            <div class="row">
                                                <h4 class="inv-title-1">Customer Info</h4>

                                                <div class="col-6">
                                                <p class="m-0"><span class="font-weight-bold">Name : </span>{{ $customer->name }}</p>
                                                <p class="m-0"><span class="font-weight-bold">Email : </span>{{ $customer->email }} </p>
                                                </div>
                                                <div class="col-6">
                                                <p class="m-0"><span class="font-weight-bold">Address : </span>{{ $customer->address }}</p>
                                                <p class="m-0"><span class="font-weight-bold">Phone : </span>{{ $customer->phone }}</p>
                                                </div>
                                            </div>

                                        </div>
                                </div>
                           


                            <div class="invoice-center">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-striped invoice-table">
                                        <thead class="bg-active">
                                            <tr class="tr">
                                                <th>No.</th>
                                                <th class="text-center">DTime</th>
                                                <th class="text-center">Item</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Disc.</th>
                                                <th class="text-center">U/C</th>
                                                {{-- <th class="text-center">T. Amt.</th>
                                                <th class="text-center">Vat(%)</th>
                                                <th class="text-center">T. VAT.</th> --}}
                                                <th class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @php
                                                $itemCounter = 1; // Initialize a counter variable
                                            @endphp

                                            @foreach ($invoice as $item)
                                                @foreach ($item->saleDetails as $detail)
                                                    <tr class="tr">
                                                        <td>
                                                            <div class="item-desc-1">
                                                                <span>{{ $itemCounter }}</span>
                                                                <!-- Auto-incremented item number -->
                                                            </div>
                                                        </td>

                                                        <td class="text-center">
                                                            {{ date('d/m/Y h:ia', strtotime($detail->created_at)) }}
                                                        </td>
                                                        <td class="text-center">{{ $detail->product->product_name }}
                                                        </td>
                                                        <td class="text-center">{{ $detail->unit->name }}</td>
                                                        <td class="text-center">{{ $detail->qty }}</td>
                                                        <td class="text-center">{{ $detail->price }}</td>
                                                        <td class="text-center">{{ $detail->discount ?? 0  }}</td>
                                                        <td class="text-center">{{ $detail->unit_cost }}</td>
                                                        {{-- <td class="text-center">{{ $detail->total }}</td>
                                                        <td class="text-center">{{ $detail->vat ?? 0 }}%</td>
                                                        <td class="text-center">{{ $detail->total_vat ?? 0 }}</td> --}}
                                                        <td class="text-center">{{ $detail->subtotal }}</td>
                                                    </tr>
                                                    @php
                                                        $itemCounter++; // Increment the counter for the next iteration
                                                    @endphp
                                                @endforeach
                                            @endforeach



                                            {{-- 
                                            <tr class="tr3">
                                                <td colspan="9"></td>
                                                <td class="text-center f-w-600 active-color">Grand Total</td>
                                                <td class="text-center f-w-600 active-color">{{ $invoice->grand_total }}</td>
                                            </tr>
                                            
                                            <tr class="tr3">
                                                <td colspan="9"></td>
                                                <td class="text-center">Vat On Invoice</td>
                                                <td class="text-center">{{ $invoice->vat_on_invoice ?? 0 }}</td>
                                            </tr>

                                            <tr class="tr3">
                                                <td colspan="9"></td>
                                                <td class="text-center">Total</td>
                                                <td class="text-center">{{ $invoice->total_amount }}</td>
                                            </tr>

                                            <tr class="tr3">
                                                <td colspan="9"></td>
                                                <td class="text-center">Discount</td>
                                                <td class="text-center">{{ $invoice->discount ?? 0 }}</td>
                                            </tr>

                                            <tr class="tr3">
                                                <td colspan="9"></td>
                                                <td class="text-center">Net Payable</td>
                                                <td class="text-center">{{ $invoice->net_payable }}</td>
                                            </tr>

                                            <tr class="tr3">
                                                <td colspan="9"></td>
                                                <td class="text-center">Total Paid</td>
                                                <td class="text-center">{{ $invoice->total_paid ?? 0 }}</td>
                                            </tr>

                                            <tr class="tr3">
                                                <td colspan="9"></td>
                                                <td class="text-center">Total Due</td>
                                                <td class="text-center">{{ $invoice->total_due }}</td>
                                            </tr> --}}


                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="invoice-contact clearfix">
                                <div class="row g-0">
                                    <div class="col-lg-9 col-md-11 col-sm-12">
                                        <div class="contact-info">
                                            <a href="tel:+55-4XX-634-7071"><i class="fa fa-phone"></i> +00 123 647
                                                840</a>
                                            <a href="tel:info@themevessel.com"><i class="fa fa-envelope"></i>
                                                info@themevessel.com</a>
                                            <a href="tel:info@themevessel.com" class="mr-0 d-none-580"><i
                                                    class="fa fa-map-marker"></i> 169 Teroghoria, Bangladesh</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-btn-section clearfix d-print-none">
                            <a class="btn btn-lg btn-print" id="printInvoice">
                                <i class="fa fa-print"></i> Print Invoice
                            </a>
                            <a id="downloadPdfButton" class="btn btn-lg btn-download btn-theme">
                                <i class="fa fa-download"></i> Download Invoice
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Invoice 1 end -->



    <script>
        // Function to download the invoice as PDF
        function downloadPdf() {
            const pdf = new jsPDF();
            
            // Convert the invoice content to a canvas
            const invoiceContent = document.getElementById('invoice-content');
            html2canvas(invoiceContent, {
                dpi: 300,  // You can adjust the scale as needed
                
            }).then((canvas) => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 210; // A4 page width in mm
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                
                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                pdf.save("invoice.pdf");
            });
        }

        // Attach the download function to the Download PDF button
        document.getElementById('downloadPdfButton').addEventListener('click', downloadPdf);

        // Function to print the invoice
        document.getElementById('printInvoice').addEventListener('click', function() {
            // Trigger the print dialog
            window.print();
        });
      
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="{{ asset('backend/custom/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/custom/assets/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('backend/custom/assets/js/html2canvas.js') }}"></script>
    <script src="{{ asset('backend/custom/assets/js/app.js') }}"></script>
</body>

</html>
