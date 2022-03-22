@extends('layouts.master')

@section('content')
<!-- Breadcrumbs Start -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Avialable Assets</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('asset') }}">Asset Management</a></li>
          <li class="breadcrumb-item active">Available Asset</li>
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
							<button type="button" onclick="window.location.href='{{route('asset.create')}}'" class="btn btn-info btn-rounded" data-toggle="tooltip" title="Add Job"><i class="fas fa-plus"></i><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Add Asset</button>
						</div>
			      		
			      		<hr>

						<div class="table-responsive">
							<table id="assets" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th> Type</th>
										<th> Name</th>
										<th> Brand</th>
										<th> Condition </th>
										<th> Location </th>
										<th> Entry Date </th>
										<th> Availability </th>
										<th> Allocated </th>
										@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('EmployeeController:availble'))
											<th> Actions </th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($assets as $asset)
										<tr>
											<td>{{$asset->type ?? 'N/A' }}</td>
											<td>{{$asset->name}}</td>
											<td>{{$asset->brand ?? 'N/A'}}</td>
											<td>{{$asset->condition ?? 'N/A'}}</td>
											<td>{{$asset->location ?? 'N/A'}}</td>
											<td>{{Carbon\Carbon::parse($asset->entry_date)->format('d-m-Y')}}</td>
											<td>{{($asset->active == 1) ? 'Available' : 'Unavailable' }}</td>
											<td>{{($asset->active == 0) ? 'Allocated' : 'Not allocated' }}</td>
											<td class="text-nowrap">
												@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('AssetController:handOvered'))
													<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-handover{{ $asset->id }}" data-toggle="tooltip" title="handover asset"> <i class="fas fa-pencil-alt"></i></a>
												@endif
											</td>
										</tr>
										@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('AssetController:handOvered'))
											<div class="modal fade" id="confirm-handover{{ $asset->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
											              <h4 class="modal-title">Handover Asset</h4>
											              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											                <span aria-hidden="true">×</span>
											              </button>
											            </div>
														<form action="{{ route('asset.handovered' , $asset->id )}}" method="post">
															{{ csrf_field() }}
															<div class="modal-body">
																Are you sure you want to handover Asset "{{$asset->name}}"?
																<div class="col-lg-6 col-md-6 col-sm-12">
																	<div class="form-group">
																		<label class="control-label">Employee<span class="text-danger">*</span></label>
																		<select class="form-control custom-select" data-placeholder="Choose a Employee" tabindex="1" name="employee_id">
																			<option value="">Select Employee</option>
																			@foreach($employees as $employee)
																				<option value="{{$employee->id}}">{{$employee->firstname . ' ' . $employee->lastname}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
															</div>
															<div class="modal-footer justify-content-between">
																<button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="tooltip" title="Cancel"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-window-close"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Cancel</span></button>
																<input type="hidden" name="asset_id" value="{{$asset->id}}" />
                                                            	<button  type="submit" class="btn btn-danger btn-ok" data-toggle="tooltip" title="Delete Job"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-trash-alt"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Handover</span></button>
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
	    $('#assets').DataTable({
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