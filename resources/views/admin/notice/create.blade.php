@extends('layouts.master')

@section('content')
<!-- Breadcrumbs Start -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Create Notice</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('notice') }}">Notices</a></li>
          <li class="breadcrumb-item"><a href="{{ url('notice') }}">Notice</a></li>
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
						<button type="button" onclick="window.location.href='{{route('notices.index')}}'" class="btn btn-info btn-rounded" data-toggle="tooltip" title="Back"><i class="fas fa-chevron-left"></i><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Back</span></button>

						<hr>

						<form id="createNoticeForm" action="{{route('notice.store')}}" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Title<span class="text-danger">*</span></label>
										<input type="text" name="title" class="form-control" placeholder="Enter Title">
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label class="control-label">Description<span class="text-danger">*</span></label>
										<textarea class="textarea_editor form-control" name="description" rows="10" placeholder="Enter Description"></textarea>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Image</label>
										<center>
											<input type="image" src="{{asset('assets/images/default.png')}}" class="img-circle picture-container picture-src" id="wizardPicturePreview" title="" width="90" height="90" />
											<br>
											<a class="btn btn-primary btn-sm" id="change">Add Image</a>
											<div class="form-group mb-0">
												<input type="file" name="image" id="wizard-picture" class="form-control" style="position: absolute; top: 0px;z-index: -1;">
											</div>
										</center>
									</div>
								</div>
								
							</div>

							<hr>

							<button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Create Notice"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-check-circle"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Create</span></button>
							<button type="button" onclick="window.location.href='{{route('notices.index')}}'" class="btn btn-default" data-toggle="tooltip" title="Cancel"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-window-close"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Cancel</span></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Main Content End -->

<script>
	$(document).ready(function(){
        // Prepare the preview for profile picture
        $("#wizard-picture").change(function(){
            readURL(this);
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#change").click(function() {
        $("input[id='wizard-picture']").click();
    });

    $(".form-control").keypress(function(e) {
        if (e.which == 13) {
            e.preventDefault();
            return false;
        }
    });
	$(function () {
	  $('#createNoticeForm').validate({
	    rules: {
	      title: {
	        required: true,
	      },
	      description: {
	        required: true
	      }
	    },
	    messages: {
	      title: "Notice title is required",
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