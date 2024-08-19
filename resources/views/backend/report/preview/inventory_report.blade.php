<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Inventory Report</title>
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
                            <div class="d-flex justify-content-center"> 
                                <div class="invoice-logo">
                                    <!-- logo started -->
                                    <div>
                                        <img src="{{ asset($setting->logo) }}" alt="logo">
                                    </div>
                                    <!-- logo ended -->
                                </div>
                                <div>
                                    <h3 style="border-bottom:1px solid #EE1D52; color:#F25146 ">{{ strtoupper($setting->company_name) }}</h3>
                                    <p class="m-0"><span class="font-weight-bold">Phone : </span>{{ $setting->phone_one }}, {{ $setting->phone_two }}</p>
                                    <p class="m-0"><span class="font-weight-bold">Email : </span>{{ $setting->email }}</p>
                                </div>
                            </div>

                            <div class="row mt-2 text-center">
                                <p class="font-weight-bold">Stock Report For All Products For {{ \Carbon\Carbon::createFromFormat('m/d/Y', $startDate)->format('F j, Y') }} To {{ \Carbon\Carbon::createFromFormat('m/d/Y', $endDate)->format('F j, Y') }}</p>
                            </div>

                            <div class="invoice-center">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-striped invoice-table">
                                        <thead class="bg-active">
                                            <tr class="tr">
                                                <th>#SL</th>
                                                <th class="pl0 text-center">Item</th>
                                                <th class="text-center">Opening</th>
                                                <th class="text-center">Purchase</th>
                                                <th class="text-center">P.Return</th>
                                                <th class="text-center">Sale</th>
                                                <th class="text-center">S.Return</th>
                                                <th class="text-center">C.Stock.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalPurchase=0;
                                                $totalPurchaseReturn=0;
                                                $totalSale=0; 
                                                $totalSaleReturn=0; 
                                                $totalStock=0;
                                                $totalOpening=0;
                                            @endphp
                                            @foreach ($results as $index => $item)
                                            <tr class="tr">
                                                <td class="text-center">{{ $index+1 }}</td>
                                                <td class="text-start">{{ $item->product_name }}</td>
                                                <td class="text-center">{{ $item->opening }}</td>
                                                <td class="text-center">{{ $item->purchase }}</td>
                                                <td class="text-center">{{ $item->purchasereturn }}</td>
                                                <td class="text-center">{{ $item->sales }}</td>
                                                <td class="text-center">{{ $item->salesreturn }}</td>
                                                <td class="text-center">{{ ($item->opening + $item->purchase + $item->salesreturn) - ($item->sales + $item->purchasereturn) }}</td>
                                            
                                                @php
                                                $totalPurchase+=$item->purchase;
                                                $totalPurchaseReturn+=$item->purchasereturn;
                                                $totalSale+=$item->sales; 
                                                $totalSaleReturn+=$item->salesreturn; 
                                                $totalStock+=($item->opening + $item->purchase + $item->salesreturn) - ($item->sales + $item->purchasereturn);
                                                $totalOpening+= $item->opening;
                                                @endphp
                                            
                                            </tr> 
                                        @endforeach
                                        <tr class="tr3 custom-border">
                                            <td colspan="1"></td>
                                            <td class="text-end f-w-600 active-color">Total</td>
                                            <td class="text-center f-w-600 active-color">{{ $totalOpening }}</td>
                                            <td class="text-center f-w-600 active-color">{{ $totalPurchase }}</td>
                                            <td class="text-center f-w-600 active-color">{{ $totalPurchaseReturn }}</td>
                                            <td class="text-center f-w-600 active-color">{{ $totalSale }}</td>
                                            <td class="text-center f-w-600 active-color">{{ $totalSaleReturn }}</td>
                                            <td class="text-center f-w-600 active-color">{{ $totalStock }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="invoice-bottom">
                                <div class="row">
                                    <div class="col-lg-6 col-md-8 col-sm-7">
                                        <div class="mb-30 dear-client">
                                            <h3 class="inv-title-1">Terms & Conditions</h3>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. Lorem Ipsum has been typesetting industry. Lorem Ipsum</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-5">
                                        <div class="mb-30 payment-method">
                                            <h3 class="inv-title-1">Payment Method</h3>
                                            <ul class="payment-method-list-1 text-14">
                                                <li><strong>Account No:</strong> 00 123 647 840</li>
                                                <li><strong>Account Name:</strong> Jhon Doe</li>
                                                <li><strong>Branch Name:</strong> xyz</li>
                                            </ul>
                                        </div>
                                    </div>
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
