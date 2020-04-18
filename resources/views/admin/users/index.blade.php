@extends('layouts.index')
@extends('layouts.modal')

@section('content')
<div class="container-fluid ">
	<div class="dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="page-header" id="top">
					<h2 class="pageheader-title">Korisnici</h2>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				
				@include('partials.success')

				<div class="card">
					<h5 class="card-header">Korisnici</h5>
					<div class="card-body">
						<div class="table-responsive">
							<a id="add" class="btn btn-sm btn-info float-right ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
								Dodaj korisnika
							</a>
							<table class="table table-striped table-bordered first">
								<thead>
									<tr>
										<th class="text-center">ID</th>
										<th class="text-center">Ime i prezime</th>
										<th class="text-center">Email</th>
										<th class="text-center">Korisnička uloga</th>
										<th class="text-center">Izmijeni</th>
										<th class="text-center">Obriši</th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $user)
										<tr>
											<td class="text-center">{{ $user->id }}</td>
											<td class="text-center">{{ $user->full_name }}</td>
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
											<td>
												<form>
												<a href="javascript:void(0)" data-toggle="modal" data-id="{{$user->id}}" data-route="users/{{$user->id}}"
														data-target="#myModal" class="edit show-object-data btn btn-sm btn-success">Izmijeni</a>
												</form>
											</td>
											<td class="text-center">
												<form class="deleteForm" action="{{ route('users/delete', $user->id) }}" method="POST">
													@method('DELETE')
													@csrf
													<button class="delBtn btn btn-sm btn-danger" type="button">Obriši</button>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<a class="btn btn-sm btn-warning" href="{{ route('users.deleted') }}">Obrisani korisnici</a href="{{ route('users.deleted') }}">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')

<script>
	var route = "users/store";
	
	$('#myModal').on('hidden.bs.modal', function () {
		$(".submitForm")[0].reset();
	});
	
	$("#add").click(function(){
		route = "users/store";
	});
	
	$(".edit").click(function(){
		route = "users/edit";
	});
	
	$('.table').DataTable({
		"order": [[ 0, "desc" ]]
	});
	
	function showData(returndata){
		$('#id').val(returndata.id);
		$('#full_name').val(returndata.full_name);
		$('#email').val(returndata.email);
		$('#role_id').val(returndata.role_id);
		$('#myModal').modal('show'); 
	}
	
</script>

@section('modal-body')

<div class="modal-header">
          <h4 class="modal-title">Korisnici</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
		<form class="submitForm">
		@csrf
        <div class="modal-body">
			<div class="container">
				<input type="hidden" name="id" id="id">
				
				<div class="form-group">
					<label class="col-form-label" for="full_name">Ime i prezime</label>
					<input class="form-control" id="full_name" name="full_name" type="text" placeholder="Ime i prezime"">
				</div>

				<div class="form-group">
					<label class="col-form-label" for="email">Email</label>
					<input class="form-control" id="email" name="email" type="email" placeholder="Email">
				</div>
				
				<div class="form-group">
					<label class="col-form-label" for="role_id">Korisnička uloga</label>
					<div class="row">
						<div class="col-xs-2 col-md-2 col-lg-2 col-xl-2">
							<select id="role_id" class="form-control" name="role_id">
								@foreach($roles as $role)
									<option value="{{ $role->id }}">
										{{ ucfirst($role->name) }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-form-label" for="password">Password</label>
					<input class="form-control" name="password" type="password" placeholder="Password"> 
				</div>
								
				<div class="form-group">
					<label class="col-form-label" for="password_confirmation">Potvrdi password</label>
					<input class="form-control" name="password_confirmation" type="password" placeholder="Password"> 
				</div>

		</div>
    </div>
        
@endsection
@endsection

