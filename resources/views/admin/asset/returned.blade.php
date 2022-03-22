@extends('layouts.master')

@section('content')
<!-- Breadcrumbs Start -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Returned Assets</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('asset') }}">Asset Management</a></li>
          <li class="breadcrumb-item active">Returned Asset</li>
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
							<button type="button" onclick="window.location.href='{{route('asset.create')}}'" class="btn btn-info btn-rounded" data-toggle="tooltip" title="Add Asset"><i class="fas fa-plus"></i><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Add Asset</button>
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
										<th> Returned Date </th>
										<th> Returned from </th>
										@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('EmployeeController:returned'))
											<th> Actions </th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($returnedAssets as $asset)
										<tr>
											<td>{{$asset->asset->type ?? 'N/A' }}</td>
											<td>{{$asset->asset->name}}</td>
											<td>{{$asset->asset->brand ?? 'N/A'}}</td>
											<td>{{$asset->asset->condition ?? 'N/A'}}</td>
											<td>{{$asset->asset->location ?? 'N/A'}}</td>
											<td>{{Carbon\Carbon::parse($asset->returned_date)->format('d-m-Y')}}</td>
											<td>{{$asset->employee->firstname . ' ' . $asset->employee->lastname }}</td>
											<td class="text-nowrap">
												@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('AssetController:inactive'))
													<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-inactive{{ $asset->asset->id }}" data-toggle="tooltip" title="Inactive asset"> <i class="fas fa-pencil-alt"></i></a>
												@endif
											</td>
										</tr>
										@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('AssetController:inactive'))
											<div class="modal fade" id="confirm-inactive{{ $asset->asset->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
											              <h4 class="modal-title">Inactive Asset</h4>
											              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											                <span aria-hidden="true">×</span>
											              </button>
											            </div>
														<form action="{{ route('asset.delete' , $asset->asset->id )}}" method="post">
                                                            <input name="_method" type="hidden" value="DELETE">
															{{ csrf_field() }}
															<div class="modal-body">
																Are you sure you want to return "{{$asset->asset->name}}" from {{$asset->employee->firstname . ' ' . $asset->employee->lastname}}?
															</div>
															<div class="modal-footer justify-content-between">
																<button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="tooltip" title="Cancel"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-window-close"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Cancel</span></button>
                                                            	<button  type="submit" class="btn btn-danger btn-ok" data-toggle="tooltip" title="Delete Job"><span class="d-xs-inline d-sm-none d-md-none d-lg-none"><i class="fas fa-trash-alt"></i></span><span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Inactive</span></button>
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