@extends('layouts.index')

@section('css')
@endsection

@section('content')
<div class="container-fluid ">
	<div class="dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="page-header" id="top">
					<h2 class="pageheader-title">All Users </h2>
					<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
					<div class="page-breadcrumb">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/admin" class="breadcrumb-link">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">All Users</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				
				@include('partials.success')

				<div class="card">
					<h5 class="card-header">Users Table</h5>
					<div class="card-body">
						<div class="table-responsive">
							<a class="btn btn-sm btn-info float-right ml-3" href="{{ route('users.create') }}">
								Add New User
							</a>
							<table class="table table-striped table-bordered first">
								<thead>
									<tr>
										<th class="text-center">ID</th>
										<th class="text-center">First Name</th>
										<th class="text-center">Last Name</th>
										<th class="text-center">Username</th>
										<th class="text-center">Email</th>
										<th class="text-center">Role</th>
										<th class="text-center">Edit</th>
										<th class="text-center">Delete</th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $user)
										<tr>
											<td class="text-center">{{ $user->id }}</td>
											<td class="text-center">{{ $user->first_name }}</td>
											<td class="text-center">{{ $user->last_name }}</td>
											<td class="text-center">{{ $user->username }}</td>
											<td class="text-center">{{ $user->email }}</td>
											<td class="text-center">
												<span class="badge badge-pill
													@if($user->role->id == 1)
														{{ 'badge-success' }}
													@elseif($user->role->id == 2)
														{{ 'badge-warning' }}
													@else
														{{ 'badge-info' }}
													@endif
												">
													{{ $user->role->name }}
												</span>
											</td>
											<td class="text-center">
												<a class="btn btn-sm btn-info" href="{{ route('users.edit', $user->id) }}">Edit</a>
											</td>
											<td class="text-center">
												<form action="{{ route('users.destroy', $user->id) }}" method="POST">
													@method('DELETE')
													@csrf
													<button class="btn btn-sm btn-danger" type="submit">Delete</button>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<a class="btn btn-sm btn-warning" href="{{ route('users.deleted') }}">Deleted Users</a href="{{ route('users.deleted') }}">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection
