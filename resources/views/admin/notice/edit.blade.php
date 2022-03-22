@extends('layouts.master')

@section('content')
<!-- Breadcrumbs Start -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Notice</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="{{ url('notice') }}">Notices</a></li>
          <li class="breadcrumb-item"><a href="{{ url('notice') }}">Notice</a></li>
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
						<button type="button" onclick="window.location.href='{{route('notices.index')}}'" class="btn btn-info" title="Back"><i class="fas fa-chevron-left"></i><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Back</span></button>

						<hr>

						<form id="editNoticeForm" action="{{route('notice.update',[$notice->id])}}" method="post" enctype="multipart/form-data">
							<input name="_method" type="hidden" value="PUT">
							{{csrf_field()}}
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Notice Title<span class="text-danger">*</span></label>
										<input type="text" value="{{$notice->title}}" name="title" class="form-control" placeholder="Enter notice Title">
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label class="control-label">Description<span class="text-danger">*</span></label>
										<textarea class="textarea_editor form-control" name="description" rows="10" placeholder="Enter Description">{{$notice->description}}</textarea>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label class="control-label">Image</label>
										 <center>
											<input type="image" @if($notice->image != '') src="{{asset($notice->image)}}" @else src="{{asset('assets/images/default.png')}}" @endif class="img-circle picture-container picture-src" alt="Notice Image" id="wizardPicturePreview" title="" width="90" height="90" />
                                            <br>
                                            <a class="btn btn-primary btn-sm mt-1" onclick="document.getElementById('wizard-picture').click();">New Image</a>
                                            <div class="form-group mb-0">
                                                <input type="file" name="image" id="wizard-picture" class="form-control col-2" style="position: absolute; top: 0px;z-index: -1;">
										</center>
									</div>
								</div>
								
							</div>

							<hr>
							
							<button type="submit" class="btn btn-primary" title="Update Job"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-check-circle"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Update</span></button>
							<button type="button" onclick="window.location.href='{{route('notices.index')}}'" class="btn btn-default" title="Cancel"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-window-close"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Cancel</span></button>
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
	$(".form-control").keypress(function(e) {
        if (e.which == 13) {
            e.preventDefault();
            return false;
        }
    });

    $("#change").click(function() {
        $("input[id='wizard-picture']").click();
    });
	$(function () {
	  $('#editNoticeForm').validate({
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