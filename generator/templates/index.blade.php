@extends('layouts.index')
@extends('layouts.modal')

@section('content')
<div class="container-fluid ">
	<div class="dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="page-header" id="top">
					<h2 class="pageheader-title">Objekti</h2>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				
				@include('partials.success')
     
		<div class="card">
					<h5 class="card-header">Objekti</h5>
					<div class="card-body">
						<div class="table-responsive">
							<a id="add" class="btn btn-sm btn-info float-right ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
								Dodaj objekat
							</a>
							<table class="table table-striped table-bordered first">
								<thead>
									<tr>
										<th class="text-center">Redni broj</th>
										<!-- Marker Table Heading -->
										<th class="text-center">Izmijeni</th>
										<th class="text-center">Obriši</th>
									</tr>
								</thead>
								<tbody>
									@foreach($objects as $object)
										<tr>
											<td class="text-center">{{ $object->id }}</td>
											<!-- Marker Table Content -->
											<td class="text-center">
												<form>
													<a href="javascript:void(0)" data-toggle="modal" data-id="{{$object->id}}" data-route="data-route-marker"
														data-target="#myModal" class="edit show-object-data btn btn-sm btn-success">Izmijeni</a>
												</form>
                                            </td>
											<td class="text-center">
												<form class="deleteForm" action="{{ route('tableNameMarker/delete', $object->id) }}" method="POST">
													@method('DELETE')
													@csrf
													<button type="button" class="delBtn btn btn-sm btn-danger">Obriši</button>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<a class="btn btn-sm btn-warning" href="{{ route('admin/tableNameMarker/deleted') }}">Izbrisani objekti</a>
					</div>
				</div>
			</div>
        </div>

	</div>
</div>
@endsection

@section('js')

<script>

	$('#myModal').on('hidden.bs.modal', function () {
		$(".submitForm")[0].reset();
		//CloseModalMarker
	});

	$("#add").click(function(){
		$('.objectForm').attr('action', "{{ route('tableNameMarker/store') }}");
	});
	
	$(".edit").click(function(){
		var url = "{{ route('tableNameMarker/edit', ':id') }}";
		url = url.replace(':id', $(this).data('id'));
		$('.objectForm').attr('action', url);
	});

	function showData(returndata){
		//OpenModalMarker
		$('#myModal').modal('show'); 
	}

</script>

@section('modal-body')
<div class="modal-header">
          <h4 class="modal-title">Objekat</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
		<form class="submitForm objectForm" action="{{ route('tableNameMarker/store') }}">
		@csrf
        <div class="modal-body">
			<div class="container">


				<!-- InputsMarker -->




		</div>
    </div>
        
@endsection

@endsection
