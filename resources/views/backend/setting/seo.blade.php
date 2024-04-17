@extends('admin.admin_master')
@section('admin')
    <div class="container-full">

        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Seo Setting Page </h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('seo-setting.update', $seo->id) }}">
                                @csrf
								@method('put')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Meta Title <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="meta_title" class="form-control"
                                                    value="{{ $seo->meta_title }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Meta Author <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="meta_author" class="form-control"
                                                    value="{{ $seo->meta_author }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Meta Keyword <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="meta_keyword" class="form-control"
                                                    value="{{ $seo->meta_keyword }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Meta Description <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="meta_description" id="meta_description" class="form-control form-control-sm">{{ $seo->meta_description }}</textarea>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <h5>Google Analytics <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="google_analytics" id="google_analytics" class="form-control form-control-sm">{{ $seo->google_analytics }}</textarea>
                                            </div>
                                        </div>

										<button type="submit" class="btn btn-sm btn-success mt-2">Submit</button>

                                    </div>
									
                                    
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->

				<div class="box">
					<div class="box-body ml-15">
						<div class="row">
							<div class="form-group">
								<label class="font-weight-bold">Meta Title</label>
								<div class="controls">
									<p>{{ $seo->meta_title }}</p>
	
								</div>
							</div>
						</div>
	
						<div class="row">
							<div class="form-group">
								<label class="font-weight-bold">Meta Author</label>
								<div class="controls">
									<p>{{ $seo->meta_author }}</p>
								</div>
							</div>
						</div>
	
						<div class="row">
							<div class="form-group">
								<label class="font-weight-bold">Meta Keyword</label>
								<div class="controls">
									<p>{{ $seo->meta_keyword }}</p>
								</div>
							</div>
						</div>
	
						<div class="row">
							<div class="form-group">
								<label class="font-weight-bold">Meta Description</label>
								<div class="controls">
									<p>{{ $seo->meta_description }}</p>
								</div>
							</div>
						</div>
	
						<div class="row">
							<div class="form-group">
								<label class="font-weight-bold">Google Analytics</label>
								<div class="controls">
									<p>{{ $seo->google_analytics }}</p>
								</div>
							</div>
						</div>

					</div>
				</div>
            </div>
            <!-- /.box -->
        </section>
    </div>
@endsection
