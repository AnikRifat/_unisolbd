@extends('admin.admin_master')

@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Product<span class="text-danger">*</span></label>
                        <div class="controls">
                            <select name="product_id" id="product_id" class="form-control form-control-sm select2">
                                <option selected="true" disabled="disabled" value="">
                                    Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>No. of Barcode<span class="text-danger">*</span></label>
                        <div class="controls">
                            <div class="input-group">
                                <input type="text" id="number" name="number" class="form-control form-control-sm number" placeholder="Search"> 
                                <span class="input-group-append">
                                  <button id="btnPrint" class="btn btn-info btn-sm" type="button">Go!</button>
                                </span> </div>
                                @error('number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>

                </div>
              
            </div>
        </section>

    </div>

    <script>
        $(document).ready(function() {
            // Attach a click event handler to the preview button
            $('#btnPrint').click(function() {
                // Get the value of the selected date range
                var product_id = $('#product_id').val();
                var number = $('#number').val();

                // Log the start and end dates to the console
                console.log("product_id date:", product_id);
                console.log("End date:", number);


                // Construct the URL for the new tab
                var previewUrl = "{{ route('barcode.print') }}?product_id=" + product_id +
                    "&number=" + number;

                // Open a new tab with the preview URL
                var newTab = window.open(previewUrl, '_blank');

                // Prevent the default form submission
                return false;

            });
        });
    </script>

    
@endsection
