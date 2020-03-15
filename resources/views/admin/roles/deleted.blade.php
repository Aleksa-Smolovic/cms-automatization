@extends('layouts.index')

@section('css')
@endsection

@section('content')
<div class="container-fluid">
	<div class="dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="page-header" id="top">
					<h2 class="pageheader-title">Roles </h2>
					<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
					<div class="page-breadcrumb">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/admin" class="breadcrumb-link">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Roles</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 offset-xl-2 offset-lg-2 offset-md-2 offset-xs-2">
				
				@include('partials.error', ['name' => 'aborted'])
				@include('partials.success')

				<div class="card">
					<h5 class="card-header">Deleted Roles Table</h5>
					<div class="card-body">
						<div class="table-responsive">
							@if($roles->count() > 0)
								<table class="table table-striped table-bordered first">
									<thead>
										<tr>
											<th class="text-center">ID</th>
											<th class="text-center">Role Name</th>
											<th class="text-center">Restore</th>
										</tr>
									</thead>
									<tbody>
										@foreach($roles as $role)
											<tr>
												<td class="text-center">{{ $role->id }}</td>
												<td class="text-center">{{ $role->name }}</td>
												<td class="text-center">
													<form action="{{ route('roles.restore', $role->id) }}" method="POST">
														@csrf
														<button class="btn btn-sm btn-info" type="submit">Restore</button>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							@else
								<h2>There are no deleted Roles, <a class="text-primary" href="{{ route('roles.index') }}">Go back.</a></h2>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection