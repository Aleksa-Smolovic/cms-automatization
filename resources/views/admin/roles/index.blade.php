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
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

				@include('partials.error', ['name' => 'aborted'])
				@include('partials.success')

				<div class="card">
					<h5 class="card-header">Roles Table</h5>
					<div class="card-body">
						<div class="table-responsive">
							<a class="btn btn-sm btn-info float-right ml-3" href="{{ route('roles.create') }}">
								Add New Role
							</a>
							<table class="table table-striped table-bordered first">
								<thead>
									<tr>
										<th class="text-center">ID</th>
										<th class="text-center">Role</th>
										<th class="text-center">Users</th>
										<th class="text-center">Edit</th>
										<th class="text-center">Delete</th>
									</tr>
								</thead>
								<tbody>
									@foreach($roles as $role)
										<tr>
											<td class="text-center">{{ $role->id }}</td>
											<td class="text-center">{{ $role->name }}</td>
											<td class="text-center">
												@foreach($role->users as $user)
													<a href="{{ route('users.edit', $user->id) }}">
														{{ $user->username }}
													</a>
													<span class="text-danger">|</span>
												@endforeach
												{{-- {!! $role->users->implode('username', '<span class="text-danger"> | </span>') !!} --}}
											</td>
											<td>
												<a class="btn btn-sm btn-info" href="{{ route('roles.edit', $role->id) }}">Edit</a>
											</td>
											<td class="text-center">
												<form action="{{ route('roles.destroy', $role->id) }}" method="POST">
													@method('DELETE')
													@csrf

													<button class="btn btn-danger btn-sm" type="submit">Delete</button>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<a class="btn btn-sm btn-warning" href="{{ route('roles.deleted') }}">Deleted Roles</a href="{{ route('roles.deleted') }}">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection