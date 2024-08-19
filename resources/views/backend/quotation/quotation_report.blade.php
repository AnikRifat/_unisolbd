<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Quotation Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('backend/custom/assets/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('backend/custom/assets/fonts/font-awesome/css/font-awesome.min.css') }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset($setting->logo) }}">


    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('backend/custom/assets/css/style.css') }}">


</head>

<body>

    <style>
        .invoice-1.invoice-content .custom-border td {
            border: 0px;
        }

        #logo {
            height: 90px;
            width: 110px;
            margin-left: -0.75rem !important;
        }

        html {
            font-family: 'Poppins', sans-serif;
        }

        .custom-border-1 {
            border-bottom: 1px solid #ED877A;
            background: linear-gradient(90deg, rgba(232, 103, 87, 1) 31%, rgba(88, 106, 163, 1) 41%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .custom-border-2 {
            height: 30px;
            background: linear-gradient(90deg, rgba(88, 102, 160, 1) 0%, rgba(107, 172, 214, 1) 78%);
        }

        .custom-border-3 {
            height: 20px;
            background: rgba(107, 172, 214, 1);
        }

        .quotaion-invoice {
            width: 140px;
            font-size: 20px;
            border-bottom: 4px solid #6BACD6;
            /* border-top: 19px solid #6BACD6; */
            position: absolute;
            font-weight: 700;
            color: #F2899A;
            top: 0px;
            background: white;
            height: 40px;

        }

        .custom-border-4 {
            height: 6px;
            background: rgba(107, 172, 214, 1);
        }


        /* .invoice-1 .table td, .invoice-1 .table th{
            border: 2px solid #21242a;
        } */
        .table {
            color: black;
        }



        thead {
            display: table-row-group;
            /* Do not repeat header on each printed page */
        }

        .w-th-100 {
            width: 100px;
            /* Specify the width for printing */
        }

      
    </style>

<style>
    @media print {

        .w-th-100 {
            width: 100px;
            /* Specify the width for printing */
        }

        @page {
            size: A3;
            margin: 1cm 0.2cm 1cm 0.2cm;
        }

          .footer{
            position: absolute;
            bottom: 0;
            width: 100%
        }
    }
</style>




    <!-- Invoice 1 start -->
    <div class="invoice-1 invoice-content m-0 p-0">
        <div class="container">
            <div class="row custom-border-2 m-0 position-relative header">
                <div class="col-6">

                </div>
                <div class="col-6">
                    <div class="quotaion-invoice d-flex flex-column justify-content-between">
                        <div class="mt-auto">
                            <p class="text-center m-0">{{ $type == 'quotation' ? 'QUOTATION' : 'INVOICE' }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row align-items-center" style="margin:24px 0px 10px 0px">
                <div class="col-6 font-16">
                    <img id="logo" src="{{ asset($setting->logo) }}" alt="logo">
                    <p class="mt-2 mb-1" style="font-weight: 600;">Sales Center : {{ $setting->company_address }}
                    </p>
                    <span>Voice : {{ $setting->phone_one }};</span> <span>Email : {{ $setting->email }}</span>
                    <p class="mb-0">Web: www.trusttech.com.bd</p>


                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-3">
                            <p class="m-0">Date</p>
                            <p class="m-0">Quote No</p>
                            <p class="m-0">Salesperson</p>
                        </div>
                        <div class="col-1">
                            <p class="m-0">:</p>
                            <p class="m-0">:</p>
                            <p class="m-0">:</p>
                        </div>
                        <div class="col-6">
                            <p class="m-0">
                                {{ \Carbon\Carbon::parse($invoice->date)->locale('en')->isoFormat('D MMMM YYYY') }}
                            </p>
                            <p class="m-0">{{ $invoice->invoice_no }}</p>
                            <p class="m-0">
                                {{ $invoice->admin ? strtoupper($invoice->admin->name) : '' }}</p>
                        </div>
                    </div>
                </div>
            </div>


            @if ($type!='sale')
            <div class="row gx-1 ">
                <div class="col-6">
                    <div class="custom-border-3"> </div>
                </div>
                <div class="col-6">
                    <div class="custom-border-3"></div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-6">
                    <p class="ms-2 mb-1">TO</p>
                </div>
                <div class="col-6">
                    <p class="ms-2 mb-1">SUBJECT</p>
                </div>
            </div>

            <div class="row gx-1 ">
                <div class="col-6">
                    <div class="custom-border-4"> </div>
                </div>
                <div class="col-6">
                    <div class="custom-border-4"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mt-1 mb-2">
                    <p class="ms-2">{{ strtoupper($invoice->to) }}</p>
                </div>
                <div class="col-6 mt-1 mb-2">
                    <p class="ms-2">{{ strtoupper($invoice->subject) }}</p>
                </div>
            </div>

            @else
            <div class="row gx-1 my-4">
                <div class="col-6">
                    <div class="custom-border-3"> </div>
                </div>
                <div class="col-6">
                    <div class="custom-border-3"></div>
                </div>
            </div>
            @endif




            @php
                $showDiscountColumn = false; // Initialize the variable to false

                foreach ($type == 'quotation' ? $invoice->customerPackageItems : $invoice->saleDetails as $index => $item) {
                    $total = 0;
                    $discount = optional($item)->discount;

                    if ($discount !== null && $discount > 0) {
                        // Discount is present and greater than 0
                        $showDiscountColumn = true; // Set the variable to true
                        break; // Exit the loop as soon as one item with a discount greater than 0 is found
                    }
                }
            @endphp

            <!-- Rest of your loop code goes here -->







            <div class="row">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead style="background:rgba(107, 172, 214, 1)">
                            <tr class="tr">
                                <th class="text-center">SL</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th class="text-center">UOM</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center w-th-100">U.Price</th>
                                @if ($showDiscountColumn)
                                    <th class="text-center w-th-100">DISC.</th>
                                @endif
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>



                            @foreach ($type == 'quotation' ? $invoice->customerPackageItems : $invoice->saleDetails as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $item->product->quotation_product_name }}</td>
                                    <td>{{ $item->product->quotation_short_descp }}</td>
                                    <td class="text-center">{{ $item->unit->name }}</td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td class="text-center">
                                        {{ number_format($item->price) }}{{ $currency->symbol }}</td>

                                    @if ($showDiscountColumn)
                                        <td class="text-center w-th-100">{{ $item->discount }}</td>
                                    @endif

                                    <td class="text-end">{{ number_format($item->total) }}{{ $currency->symbol }}
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="{{ $showDiscountColumn ? 6 : 5 }}" style="border: none"></td>
                                <td class="text-start font-weight-bold w-th-100 pb-0">Total Amt</td>
                                <td class="text-end font-weight-bold w-th-100 pb-0">
                                    {{ number_format($invoice->total) }}{{ $currency->symbol }}</td>
                            </tr>

                            @php
                                $discount = $invoice->discount;
                                $checkDiscount = true;
                                $total = $invoice->total;
                                $discountAmount = 0; // Default discount amount

                                // Check if $discount is not null and contains a percentage value
                                if ($discount !== null && preg_match('/^\d+(\.\d+)?%$/', $discount)) {
                                    // Assuming $percentageDiscount is a string like '10%'
                                    $percentageDiscount = str_replace('%', '', $discount);
                                    $discountAmount = intval(($percentageDiscount / 100) * $total);
                                } elseif ($discount !== null) {
                                    // If $discount is not null and not a percentage, use it as the discount amount
                                    $discountAmount = intval($discount);
                                    $checkDiscount = false;
                                }
                            @endphp






                            @if ($invoice->discount != null)
                                <tr>
                                    <td colspan="{{ $showDiscountColumn ? 6 : 5 }}" style="border: none"></td>

                                    @if ($checkDiscount)
                                        <td class="text-start font-weight-bold w-th-100 py-0">
                                            Discount({{ $invoice->discount }})</td>
                                        <td class="text-end font-weight-bold w-th-100 py-0">
                                            {{ number_format($discountAmount) }}{{ $currency->symbol }}</td>
                                    @else
                                        <td class="text-start font-weight-bold w-th-100 py-0">Discount</td>
                                        <td class="text-end font-weight-bold w-th-100 py-0">
                                            {{ number_format($invoice->discount) }}{{ $currency->symbol }}
                                        </td>
                                    @endif
                                </tr>

                                <tr>
                                    <td colspan="{{ $showDiscountColumn ? 6 : 5 }}" style="border: none"></td>
                                    <td class="text-start font-weight-bold w-th-100 pt-0">Net Payable</td>
                                    <td class="text-end font-weight-bold w-th-100 pt-0">
                                        {{ number_format($invoice->net_payable) }}{{ $currency->symbol }}</td>
                                </tr>
                            @endif

                            @if ($type == 'quotation-invoice')
                                <tr>
                                    <td colspan="{{ $showDiscountColumn ? 6 : 5 }}" style="border: none"></td>
                                    <td class="text-start font-weight-bold w-th-100 pt-0">Total Paid</td>
                                    <td class="text-end font-weight-bold w-th-100 pt-0">
                                        {{ number_format($invoice->total_paid) }}{{ $currency->symbol }}</td>
                                </tr>

                                <tr>
                                    <td colspan="{{ $showDiscountColumn ? 6 : 5 }}" style="border: none"></td>
                                    <td class="text-start font-weight-bold w-th-100 pt-0">Total Due</td>
                                    <td class="text-end font-weight-bold w-th-100 pt-0">
                                        {{ number_format($invoice->total_due) }}{{ $currency->symbol }}</td>
                                </tr>
                            @endif



                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                {!! $setting->quotation_notice !!}
            </div>



            <div class="footer">
                <div class="row custom-border-4 mx-0">
                </div>

                <div class="row custom-border-2 mx-0 mt-2">
                </div>
            </div>





            <div class="row">
                <div class="invoice-btn-section clearfix d-print-none">
                    <a class="btn btn-lg btn-print" id="printInvoice">
                        <i class="fa fa-print"></i> Print Quotation
                    </a>
                </div>
            </div>



        </div>
    </div>
    <!-- Invoice 1 end -->


    <script>
        document.getElementById('printInvoice').addEventListener('click', function () {
            window.print();
        });
    </script>

</body>

</html>
