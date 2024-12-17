
@extends('frontend.main_master')

@section('content')
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
    <link rel="shortcut icon" href="{{ asset($setting->logo) }}" type="image/x-icon">


    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('backend/custom/assets/css/style.css') }}">


</head>

<body>

    <style>
        .invoice-1.invoice-content .custom-border td {
            border: 0px;
        }
    </style>
    <!-- Invoice 1 start -->
    <div class="invoice-1 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner clearfix">
                        <div class="invoice-info clearfix" id="invoice-content">
                            <div class="d-flex justify-content-center">
                                <div class="invoice-logo">
                                    <!-- logo started -->
                                    <div>
                                        <img src="{{ asset($setting->logo) }}" alt="logo">
                                    </div>
                                    <!-- logo ended -->
                                </div>

                                <div>
                                    <h3
                                        style="border-bottom:1px solid red;  background:linear-gradient(90deg, rgba(232,103,87,1) 31%, rgba(88,106,163,1) 41%);
                                    -webkit-background-clip: text;
                                    background-clip: text;
                                    color: transparent;">
                                        {{ strtoupper($setting->company_name) }}</h3>
                                    <p class="m-0"><span class="font-weight-bold">Phone :
                                        </span>{{ $setting->phone_one }}, {{ $setting->phone_two }}</p>
                                    <p class="m-0"><span class="font-weight-bold">Email :
                                        </span>{{ $setting->email }}</p>
                                </div>
                            </div>

                            <div class="text-center my-3">
                                <p class="font-weight-bold">Your Items for {{ $customer_package->package->name }}
                                </p>
                            </div>


                            <div class="row my-4">
                                <div class="col-4">
                                    <p class="m-0"><span class="font-weight-bold">Name :
                                        </span>{{ $customer_package->user->name }}</p>
                                </div>
                                <div class="col-4">
                                    <p class="m-0"><span class="font-weight-bold">Phone :
                                        </span>{{ $customer_package->user->phone }}</p>
                                </div>
                                <div class="col-4">
                                    <p class="m-0"><span class="font-weight-bold">Email :
                                        </span>{{ $customer_package->user->email }}</p>
                                </div>
                            </div>



                            <div class="invoice-center mt-2">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-striped invoice-table">
                                        <thead class="bg-active">
                                            <tr class="tr">
                                                <th>No.</th>
                                                <th class="text-center">Component</th>
                                                <th class="text-center">Item</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                                $total = 0;
                                            @endphp

                                            @foreach ($customer_package->customerPackageItems as $index => $item)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td class="text-center">{{ $item->component }}</td>

                                                    <td><img src="{{ asset($item->product->product_thambnail) }}"
                                                            alt=""
                                                            style="height:40px; width:40px; margin-right:10px">
                                                        {{ $item->product->product_name }}

                                                    </td>

                                                    <td class="text-center">{{ $item->price }}{{ $currency->symbol }}</td>
                                                    <td class="text-center">{{ $item->qty }}</td>
                                                    <td class="text-center">{{ $item->qty * $item->price }}{{ $currency->symbol }}</td>


                                                </tr>

                                                @php
                                                    $total += $item->qty * $item->price;
                                                @endphp
                                            @endforeach

                                            <tr class="tr3 custom-border">
                                                <td colspan="4"></td>
                                                <td class="text-center f-w-600 active-color">Total</td>
                                                <td class="text-center f-w-600 active-color">
                                                    {{ $total }}{{ $currency->symbol }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- <div class="invoice-contact clearfix">
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
                            </div> --}}
                        </div>
                        <div class="invoice-btn-section clearfix d-print-none">
                            <a class="btn btn-lg btn-print text-light" id="printInvoice">
                                <i class="fa fa-print"></i> Print Quotation
                            </a>
                            <a id="downloadPdfButton" class="btn btn-lg btn-download btn-theme text-light">
                                <i class="fa fa-download"></i> Download Quotation
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
                dpi: 300, // You can adjust the scale as needed

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
@endsection

