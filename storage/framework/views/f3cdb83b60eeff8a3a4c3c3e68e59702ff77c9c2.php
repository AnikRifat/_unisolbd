<?php $__env->startSection('admin'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?php echo e(asset('backend/js/pages/editor.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor_components/ckeditor/ckeditor.js')); ?>"></script>

    <style>
        .image-area {
            position: relative;
        }

        .image-area img {
            max-width: 100%;
            height: auto;
            margin: 12px;
        }

        .remove-image {
            display: none;
            position: absolute;
            top: -2px;
            left: 60px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .remove-image:hover {
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -2px;
            left: 60px;
        }

        .remove-image:active {
            background: #E54E4E;
            top: -2px;
            left: 60px;
        }
    </style>
    <div class="container-full">

        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Site settings</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="<?php echo e(route('site-setting.update', $setting->id)); ?>"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Site Logo</label>
                                    <div class="controls">
                                        <input type="file" id="logo" name="logo" class="form-control"
                                            onchange="mainThamUrl(this)">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone One </label>
                                    <div class="controls">
                                        <input type="text" name="phone_one" class="form-control"
                                            value="<?php echo e($setting->phone_one); ?>">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Two </label>
                                    <div class="controls">
                                        <input type="text" name="phone_two" class="form-control"
                                            value="<?php echo e($setting->phone_two); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Copyright </label>
                                    <div class="controls">
                                        <input type="text" name="copyright" class="form-control"
                                            value="<?php echo e($setting->copyright); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email </label>
                                    <div class="controls">
                                        <input type="text" name="email" class="form-control"
                                            value="<?php echo e($setting->email); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company Name </label>
                                    <div class="controls">
                                        <input type="text" name="company_name" class="form-control"
                                            value="<?php echo e($setting->company_name); ?>">
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Company Address </label>
                                    <div class="controls">
                                        <textarea rows="1" type="text" name="company_address" class="form-control form-control-sm"><?php echo e($setting->company_address); ?> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About Us</label>
                                    <div class="controls">

                                        <textarea id="editor1" name="about_us" rows="10" cols="80"><?php echo e($setting->about_us); ?> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>FAQs</label>
                                    <div class="controls">

                                        <textarea id="editor2" name="faqs" rows="10" cols="80"><?php echo e($setting->faqs); ?> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Terms & Conditions<span class="text-danger">*</span></label>
                                    <div class="controls">

                                        <textarea id="editor3" name="terms_condition" rows="10" cols="80"><?php echo e($setting->terms_condition); ?> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Quotation Notice<span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <textarea id="editor4" name="quotation_notice" rows="10" cols="80"><?php echo e($setting->quotation_notice); ?> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                    </form>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


            <div class="box">
                <div class="box-body ml-15">
                    <div class="row">
                        <div class="form-group">
                            <label class="font-weight-bold">Logo</label>
                            <div class="controls">
                                <img src="<?php echo e(asset($setting->logo)); ?>" alt="">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label class="font-weight-bold">Phone One</label>
                            <div class="controls">
                                <p><?php echo e($setting->phone_one); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label class="font-weight-bold">Phone Two</label>
                            <div class="controls">
                                <p><?php echo e($setting->phone_two); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label class="font-weight-bold">Copyright</label>
                            <div class="controls">
                                <p><?php echo e($setting->copyright); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label class="font-weight-bold">Email</label>
                            <div class="controls">
                                <p><?php echo e($setting->email); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label class="font-weight-bold">Company Name</label>
                            <div class="controls">
                                <p><?php echo e($setting->company_name); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label class="font-weight-bold">Company Address</label>
                            <div class="controls">
                                <p><?php echo e($setting->company_address); ?></p>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group">
                            <label class="font-weight-bold">About Us</label>
                            <div class="controls">
                                <p><?php echo $setting->about_us; ?></p>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="form-group">
                            <label class="font-weight-bold">FAQs</label>
                            <div class="controls">
                                <p><?php echo $setting->faqs; ?></p>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group">
                            <label class="font-weight-bold">Terms Condition</label>
                            <div class="controls">
                                <p><?php echo $setting->terms_condition; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label class="font-weight-bold">Quotation Notice</label>
                            <div class="controls">
                                <p><?php echo $setting->quotation_notice; ?></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </section>
    </div>



    

    <script>
        function mainThamUrl(input) {
    if (input.files && input.files[0]) {
        // Create the image container div
        var imageContainer = $('<div>').addClass('image-area');
        
        // Create the image element
        var imgElement = $('<img>').attr({
            'src': '',
            'alt': 'Preview',
            'id': 'mainThmb',
            'height': '60px',
            'width': '60px'
        });
        
        // Create the remove link element
        var removeLink = $('<a>').addClass('remove-image').attr({
            'href': '#',
            'style': 'display: inline;'
        }).html('&#215;');
        
        // Append the img and a elements to the image container div
        imageContainer.append(imgElement).append(removeLink);
        
        // Remove any existing mainThmb and image-area elements
        $('#mainThmb').remove();
        $('.image-area').remove();
        
        // Append the image container to the document
        $('#logo').after(imageContainer);
        
        // Read and display the selected image
        var reader = new FileReader();
        reader.onload = function(e) {
            imgElement.attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
        
        // Add a click event handler to the remove link
        removeLink.on('click', function(e) {
            e.preventDefault();
            // Remove the parent image-area div
            imageContainer.remove();
            // Reset the input field logo to null (clear the selected file)
            $('#logo').val(null);
        });
    }
}

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/backend/setting/site.blade.php ENDPATH**/ ?>