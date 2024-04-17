<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Product Barcode</title>
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
    <style>
        .barcode{
            height: 40px;
            width:160px;
        }
    </style>
</head>

<body>
    <!-- Invoice 1 start -->
    <div class="invoice-1 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                       @for ($i = 0; $i <=$number ; $i++)
                       <div class="col-md-3 mb-10">
                        <img class="barcode" src="data:image/png;base64,{{ $base64Barcode }}" alt="Barcode"/>
                        </div>
                       @endfor
                        
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="invoice-inner clearfix">
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
