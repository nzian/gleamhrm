@extends('layouts.master')

@section('content')
<!-- Breadcrumbs Start -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Desciplinary</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('desciplinary') }}">People Management</a></li>
          <li class="breadcrumb-item active">Desciplinary</li>
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
						<div class="text-right">
							<button type="button" onclick="window.location.href='{{route('desciplinary.create')}}'" class="btn btn-info btn-rounded" data-toggle="tooltip" title="Add Job"><i class="fas fa-plus"></i><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Add Desciplinary</button>
						</div>
			      		
			      		<hr>

						<div class="table-responsive">
							<table id="desciplinaries" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th> Title</th>
										<th> Description</th>
										<th> Employee</th>
										<th> Team </th>
										<th> Status </th>
										@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('EmployeeController:index'))
											<th> Actions </th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($desciplinaries as $descipline)
										<tr>
											<td>{{$descipline->title}}</td>
											<td>{{$descipline->description}}</td>
											<td>{{isset($descipline->employee_id) ? $descipline->employee->full_name : 'N/A'}}</td>
											<td>{{isset($descipline->team_id) ? $descipline->team->name : 'N/A'}}</td>
											<td>{{$descipline->action }}</td>
											<td class="text-nowrap">
												@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('DesciplinaryController:edit'))
													<a class="btn btn-warning btn-sm" href="{{route('desciplinary.edit',[$descipline->id])}}" data-toggle="tooltip" title="Edit desciplinary"> <i class="fas fa-pencil-alt text-white"></i></a>
													<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-delete{{ $descipline->id }}" data-toggle="tooltip" title="Delete desciplinary"> <i class="fas fa-trash-alt"></i></a>
												@endif
											</td>
										</tr>
										@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('DesciplinaryController:destroy'))
											<div class="modal fade" id="confirm-delete{{ $descipline->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
											              <h4 class="modal-title">Delete Desciplinary</h4>
											              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											                <span aria-hidden="true">×</span>
											              </button>
											            </div>
														<form action="{{ route('desciplinary.delete' , $descipline->id )}}" method="post">
															<input name="_method" type="hidden" value="DELETE">
															{{ csrf_field() }}
															<div class="modal-body">
																Are you sure you want to delete Desciplinary "{{$descipline->title}}"?
															</div>
															<div class="modal-footer justify-content-between">
																<button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="tooltip" title="Cancel"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-window-close"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Cancel</span></button>
                                                            	<button  type="submit" class="btn btn-danger btn-ok" data-toggle="tooltip" title="Delete Job"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-trash-alt"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Delete</span></button>
															</div>
														</form>
													</div>
												</div>
											</div>
										@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Main Content End -->

<script>
  	$(document).ready(function () {
	    $('#desciplinaries').DataTable({
	      "paging": true,
	      "lengthChange": true,
	      "searching": true,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false,
	      "responsive": true,
	    });
  	});
</script>
@stop