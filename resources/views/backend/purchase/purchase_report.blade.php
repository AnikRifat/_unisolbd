<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Purchase Report</title>
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
    <style>
        .invoice-1.invoice-content .custom-border td{
            border: 0px;
        }
    </style>

   

    <!-- Invoice 1 start -->
    <div class="invoice-1 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner clearfix">
                        <div class="invoice-info clearfix" id="invoice_wrapper">
                            <div class="invoice-headar">
                                <div class="row g-0">
                                    <div class="col-sm-6">
                                        <div class="invoice-logo">
                                            <!-- logo started -->
                                            <div class="logo">
                                                <img src="{{ asset($setting->logo) }}" alt="logo">
                                            </div>
                                            <!-- logo ended -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6 invoice-id">
                                        <div class="info">
                                            <h1 class="color-white inv-header-1">Invoice</h1>
                                            <p class="color-white mb-1">Invoice Number <span>#{{ $invoice->invoice_no }}</span></p>
                                            <p class="color-white mb-0">Invoice Date <span>{{ $invoice->created_at->format('d M Y') }}</span></p>
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
                                                <th class="text-center">Item</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Disc.</th>
                                                <th class="text-center">U/C</th>
                                                {{-- <th class="text-center">T. Amt.</th>
                                                <th class="text-center">Vat(%)</th>
                                                <th class="text-center">T. VAT.</th> --}}
                                                <th class="text-center">Total.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoice->purchaseDetails as $detail)
                                            <tr class="tr">
                                                <td>
                                                    <div class="item-desc-1">
                                                        <span>{{ $loop->iteration }}</span> <!-- Auto-incremented item number -->
                                                    </div>
                                                </td>
                                                
                                              
                                                <td class="text-center">{{ $detail->product->product_name }}</td>
                                                <td class="text-center">{{ $detail->unit->name }}</td>
                                                <td class="text-center">{{ $detail->qty }}</td>
                                                <td class="text-center">{{ $detail->price }}</td>
                                                <td class="text-center">{{ $detail->discount }}</td>
                                                <td class="text-center">{{ $detail->unit_cost }}</td>
                                                {{-- <td class="text-center">{{ $detail->total }}</td>
                                                <td class="text-center">{{ $detail->vat }}%</td>
                                                <td class="text-center">{{ $detail->total_vat }}</td> --}}
                                                <td class="text-center">{{ $detail->subtotal }}</td>
                                            </tr>
                                        @endforeach
                                           
                                           


                                            <tr class="tr3 custom-border">
                                                <td colspan="6"></td>
                                                <td class="text-center text-danger font-weight-bold">G.Total</td>
                                                <td class="text-center text-danger font-weight-bold">{{ $invoice->grand_total }}</td>
                                            </tr>
                                            
                                            {{-- <tr class="tr3 custom-border">
                                                <td colspan="6"></td>
                                                <td class="text-center">TAX({{$invoice->vat_on_invoice ?? 0}}%)</td>
                                                <td class="text-center">{{ $invoice->vat_on_invoice ? round($invoice->grand_total * $invoice->vat_on_invoice / 100, 0) : 0 }}</td>
                                            </tr>

                                            <tr class="tr3 custom-border">
                                                <td colspan="6"></td>
                                                <td class="text-center">Total</td>
                                                <td class="text-center">{{ $invoice->total_amount }}</td>
                                            </tr> --}}

                                            <tr class="tr3 custom-border">
                                                <td colspan="6"></td>
                                                <td class="text-center font-weight-bold">DISC.({{$invoice->discount ?? 0}}%)</td>
                                                <td class="text-center font-weight-bold">-{{ $invoice->discount ? intval($invoice->total_amount * $invoice->discount / 100) : 0 }}</td>
                                            </tr>

                                            <tr class="tr3 custom-border">
                                                <td colspan="6"></td>
                                                <td class="text-center font-weight-bold">N/Pay</td>
                                                <td class="text-center font-weight-bold">{{ $invoice->net_payable }}</td>
                                            </tr>

                                            <tr class="tr3 custom-border">
                                                <td colspan="6"></td>
                                                <td class="text-center font-weight-bold">T.Paid</td>
                                                <td class="text-center font-weight-bold">-{{ $invoice->total_paid ?? 0 }}</td>
                                            </tr>

                                            <tr class="tr3 custom-border">
                                                <td colspan="6"></td>
                                                <td class="text-center font-weight-bold">T.Due</td>
                                                <td class="text-center font-weight-bold">{{ $invoice->total_due }}</td>
                                            </tr>
                                            
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                           
                            <div class="invoice-contact clearfix">
                                <div class="row g-0">
                                    <div class="col-lg-9 col-md-11 col-sm-12">
                                        <div class="contact-info">
                                            <a href="tel:+55-4XX-634-7071"><i class="fa fa-phone"></i> {{ $setting->phone_one }}</a>
                                            <a href="tel:info@themevessel.com"><i class="fa fa-envelope"></i>
                                                {{ $setting->email  }}</a>
                                            <a href="tel:info@themevessel.com" class="mr-0 d-none-580"><i
                                                    class="fa fa-map-marker"></i> {{ $setting->company_address }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="invoice-btn-section clearfix d-print-none">
                            <a id="printInvoice" class="btn btn-lg btn-print">
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
    

    <script src="{{ asset('backend/custom/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/custom/assets/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('backend/custom/assets/js/html2canvas.js') }}"></script>
    <script src="{{ asset('backend/custom/assets/js/app.js') }}"></script>
</body>

</html>
