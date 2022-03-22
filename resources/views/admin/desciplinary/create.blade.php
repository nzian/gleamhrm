@extends('layouts.master')

@section('content')
<!-- Breadcrumbs Start -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Create Desciplinary</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('desciplinary') }}">People Management</a></li>
          <li class="breadcrumb-item"><a href="{{ url('desciplinary') }}">Desciplinary</a></li>
          <li class="breadcrumb-item active">Create</li>
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
						<button type="button" onclick="window.location.href='{{route('desciplinaries.index')}}'" class="btn btn-info btn-rounded" data-toggle="tooltip" title="Back"><i class="fas fa-chevron-left"></i><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Back</span></button>
			      		
			      		<hr>

						<form id="createDesciplinaryForm" action="{{route('desciplinary.store')}}" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Title<span class="text-danger">*</span></label>
										<input type="text" name="title" class="form-control" placeholder="Enter Title">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Action<span class="text-danger">*</span></label>
										<input type="text" name="action" class="form-control" placeholder="Enter action like varbal warning or written warning">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Employee</label>
										<select class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" name="employee_id">
											<option value="">Select Employee</option>
											@foreach($employee as $emp)
												<option value="{{$emp->id}}" @if(old("employee_id") == $emp->id) selected @endif>{{$emp->firstname}} {{$emp->lastname}})</option>
											@endforeach
										</select>
									</div>
								</div>
								@if(count($team) > 0)
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Team <span>(if employee not selected then team select)</span></label>
										<select class="form-control custom-select" data-placeholder="Choose a Team" tabindex="1" name="team_id">
											<option value="">Select Team</option>
											@foreach($team as $tm)
												<option value="{{$tm->id}}" @if(old("team_id") == $tm->id) selected @endif>{{$tm->name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								@endif
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label class="control-label">Description<span class="text-danger">*</span></label>
										<textarea class="textarea_editor form-control" name="description" rows="10" placeholder="Enter Description"></textarea>
									</div>
								</div>
							</div>

							<hr>

							<button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Create Desciplinary"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-check-circle"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Create</span></button>
							<button type="button" onclick="window.location.href='{{route('desciplinaries.index')}}'" class="btn btn-default" data-toggle="tooltip" title="Cancel"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-window-close"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Cancel</span></button>
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
	  $('#createDesciplinaryForm').validate({
	    rules: {
	      title: {
	        required: true,
	      },
	      action: {
	        required: true
	      },
	      description: {
	        required: true
	      }
	    },
	    messages: {
	      title: "Desciplinary title is required",
	      action: "Action is required",
	      description: "Description is required"
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