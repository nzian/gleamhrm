@extends('layouts.master')

@section('content')
<!-- Breadcrumbs Start -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Asset</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('asset') }}">Asset Management</a></li>
          <li class="breadcrumb-item active">Inactive Asset</li>
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
										@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('EmployeeController:index'))
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
											<td class="text-nowrap">
												@if (Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('AssetController:edit'))
													<a class="btn btn-warning btn-sm" href="{{route('asset.edit',[$asset->id])}}" data-toggle="tooltip" title="Edit asset"> <i class="fas fa-pencil-alt text-white"></i></a>
												@endif
											</td>
										</tr>
										
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