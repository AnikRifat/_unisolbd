@extends('admin.admin_master')
@section('admin')


  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">
		  <div class="row">



			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Total Admin User </h3>
                  <a href="{{ route('add.admin') }}" class="btn btn-success" style="float: right;">

                    Add Admin User
                  </a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Image  </th>
								<th>Name  </th>
								<th>Email </th> 
								<th>Access </th>
								<th>Action</th>

							</tr>
						</thead>
						<tbody>
	 @foreach($adminuser as $item)
	 <tr>
		<td style="width: 50px; height:50px"> <img src="{{ $item->profile_photo_path!=NULL? url($item->profile_photo_path) : url('upload/no_image.jpg')}}">  </td>
		<td> {{ $item->name }}  </td>
		<td> {{ $item->email  }}  </td>

		<td>
		@if ($item->brand==1)
			<span class="bedge rounded-pill  bg-primary px-3 py-1">brand</span>
		@endif  
		@if ($item->category==1)
			<span class="bedge rounded-pill bg-secondary px-3 py-1">category</span>
		@endif  
		@if ($item->product==1)
			<span class="bedge rounded-pill bg-success px-3 py-1">product</span>
		@endif  
		@if ($item->slider==1)
			<span class="bedge rounded-pill bg-danger px-3 py-1">slider</span>
		@endif  
		@if ($item->coupons==1)
			<span class="bedge rounded-pill bg-warning text-white px-3 py-1">coupons</span>
		@endif  
		@if ($item->shipping==1)
			<span class="bedge rounded-pill bg-info text-white px-3 py-1">shipping</span>
		@endif  
		@if ($item->blog==1)
			<span class="bedge rounded-pill bg-dark px-3 py-1">blog</span>
		@endif  
		@if ($item->setting==1)
			<span class="bedge rounded-pill bg-primary px-3 py-1">setting</span>
		@endif  
		@if ($item->returnorder==1)
			<span class="bedge rounded-pill bg-secondary px-3 py-1">returnorder</span>
		@endif  
		@if ($item->review==1)
			<span class="bedge rounded-pill bg-success px-3 py-1">review</span>
		@endif  
		@if ($item->orders==1)
			<span class="bedge rounded-pill bg-danger px-3 py-1">orders</span>
		@endif 
		@if ($item->stock==1)
			<span class="bedge rounded-pill bg-warning text-white px-3 py-1">stock</span>
		@endif 
		@if ($item->reports==1)
			<span class="bedge rounded-pill bg-info text-white px-3 py-1">reports</span>
		@endif 
		@if ($item->alluser==1)
			<span class="bedge rounded-pill bg-light text-white px-3 py-1">alluser</span>
		@endif 
		@if ($item->adminuserrole==1)
			<span class="bedge rounded-pill bg-dark px-3 py-1">adminuserrole</span>
		@endif 
		
		</td>


		<td width="25%">
 <a href="{{ route('edit.admin.user',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>

 <a href="{{ route('delete.admin.user',$item->id) }}" class="btn btn-danger" title="Delete" id="delete">
 	<i class="fa fa-trash" ></i></a>
		</td>

	 </tr>
	  @endforeach
						</tbody>

					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->


			</div>
			<!-- /.col -->






		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>




@endsection