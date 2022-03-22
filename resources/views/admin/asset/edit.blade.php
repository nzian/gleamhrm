@extends('layouts.master')

@section('content')
<!-- Breadcrumbs Start -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Asset</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="{{ url('asset') }}">Asset Management</a></li>
          <li class="breadcrumb-item"><a href="{{ url('asset') }}">Asset</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumbs End -->

<!-- Session Message Section Start -->
@include('layouts.partials.error-message')
<!-- Session Message Section End -->

<!-- Main Content Start -->
<div class="content">
  	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<button type="button" onclick="window.location.href='{{route('asset.index')}}'" class="btn btn-info" title="Back"><i class="fas fa-chevron-left"></i><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Back</span></button>

						<hr>

						<form id="editAssetForm" action="{{route('asset.update',[$asset->id])}}" method="post" enctype="multipart/form-data">
							<input name="_method" type="hidden" value="PUT">
							{{csrf_field()}}
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Type</label>
										<input type="text" value="{{ $asset->type }}" name="type" class="form-control" placeholder="Type computer, tablet, laptop, mobile, table, chair etc">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Name<span class="text-danger">*</span></label>
										<input type="text" name="name" value="{{ $asset->name }}" class="form-control" placeholder="Enter name">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Brand</label>
										<input type="text" name="brand" value="{{ $asset->brand }}" class="form-control" placeholder="Enter brand">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Location</label>
										<input type="text" name="location" value="{{ $asset->location }}" class="form-control" placeholder="where asset located in office or outside">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Condition</label>
										<input type="text" name="condition" value="{{ $asset->condition }}" class="form-control" placeholder="Enter condition fresh or secondhand etc">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Availablity</label>
										<select class="form-control custom-select" data-placeholder="Choose a availability" tabindex="1" name="active">
											<option value="">Select Availability</option>
												<option value="1" @if($asset->active == 1) selected @endif>Available</option>
												<option value="0" @if($asset->active == 0) selected @endif>Unavailable</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group row">
                                        <label class="control-label">Entry Date</label>
                                        <div class="col-md-12" >
                                            <input type="date" class="form-control date" name="entry_date" value="{{$asset->entry_date ?? $current_date}}">
                                            <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                        </div>
                                    </div>
                                </div>
							</div>
						

							<hr>
							
							<button type="submit" class="btn btn-primary" title="Update Asset"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-check-circle"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Update</span></button>
							<button type="button" onclick="window.location.href='{{route('asset.index')}}'" class="btn btn-default" title="Cancel"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-window-close"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Cancel</span></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Main Content End -->

<script>
	$(function () {
	  $('#createAssetForm').validate({
	    rules: {
	      name: {
	        required: true,
	      },
	      condition: {
	        required: true
	      },
	      entry_date: {
	        required: true
	      }
	    },
	    messages: {
	      title: "Asset name is required",
	      condition: "Condition is required",
	      entry_date: "Entry Date is required"
	    },
	    errorElement: 'span',
	    errorPlacement: function (error, element) {
	      error.addClass('invalid-feedback');
	      element.closest('.form-group').append(error);
	    },
	    highlight: function (element, errorClass, validClass) {
	      $(element).addClass('is-invalid');
	    },
	    unhighlight: function (element, errorClass, validClass) {
	      $(element).removeClass('is-invalid');
	    }
	  });
	});
</script>
@stop