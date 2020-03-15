@extends('layouts.index')
@extends('layouts.modal')

@section('content')
<div class="container-fluid ">
	<div class="dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="page-header" id="top">
					<h2 class="pageheader-title">Objekti</h2>
					<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
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
										<th class="text-center">Datum objave</th>
            <th class="text-center">Broj zaraženih u Crnoj Gori</th>
            <th class="text-center">Broj zaraženih u Crnoj Gori</th>
            <th class="text-center">Broj osoba pod nadzorom</th>
            <th class="text-center">Broj zaraženih u Crnoj Gori</th>
            
										<th class="text-center">Izmijeni</th>
										<th class="text-center">Obriši</th>
									</tr>
								</thead>
								<tbody>
									@foreach($objects as $object)
										<tr>
											<td class="text-center">{{ $object->id }}</td>
											<td class="text-center">{{ $object->date_published }}</td>
                <td class="text-center">{{ $object->infected_montenegro }}</td>
                <td class="text-center">{{ $object->infected_global }}</td>
                <td class="text-center">{{ $object->under_watch }}</td>
                <td class="text-center">{{ $object->tested }}</td>
                
											<td class="text-center">
												<form>
													<a href="javascript:void(0)" data-toggle="modal" data-id="{{$object->id}}" data-date_published="{{$object->date_published}}"
            data-infected_montenegro="{{$object->infected_montenegro}}"
            data-infected_global="{{$object->infected_global}}"
            data-under_watch="{{$object->under_watch}}"
            data-tested="{{$object->tested}}"
            
														data-target="#myModal" class="edit btn btn-sm btn-success">Izmijeni</a>
												</form>
                                            </td>
											<td class="text-center">
												<form class="deleteForm" action="{{ route('stats/delete', $object->id) }}" method="POST">
													@method('DELETE')
													@csrf
													<button type="button" class="delBtn btn btn-sm btn-danger" >Obriši</button>												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<a class="btn btn-sm btn-warning" href="{{ route('admin/stats/deleted') }}">Izbrisani objekti</a href="{{ route('admin/stats/deleted') }}">
					</div>
				</div>
			</div>
        </div>

	</div>
</div>
@endsection

@section('js')

<script>
var route = "stats/store";
var clickable = true;
$('#myModal').on('show.bs.modal', function(e) {
	$('#id').val( $(e.relatedTarget).data('id') );
	$('#date_published').val( $(e.relatedTarget).data('date_published') );
                $('#infected_montenegro').val( $(e.relatedTarget).data('infected_montenegro') );
                $('#infected_global').val( $(e.relatedTarget).data('infected_global') );
                $('#under_watch').val( $(e.relatedTarget).data('under_watch') );
                $('#tested').val( $(e.relatedTarget).data('tested') );
                
});

$('#myModal').on('hidden.bs.modal', function () {
	$(".submitForm")[0].reset();
	
});

$("#add").click(function(){
	route = "stats/store";
});

$(".edit").click(function(){
	route = "stats/edit";
});

$('.table').DataTable({
    "order": [[ 0, "desc" ]]
});

</script>

@section('modal-body')
<div class="modal-header">
          <h4 class="modal-title">Objekat</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
		<form class="submitForm">
		@csrf
        <div class="modal-body">
			<div class="container">
				<input type="hidden" name="id" id="id">


				
                <div class="row">
                    <div class="col-12"> 
                        <div class="form-group">
                            <label class="col-form-label" for="date_published">Datum objave *</label>
                            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                <input name="date_published" id="date_published" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                
                <div class="row">
                    <div class="col-12"> 
                        <div class="form-group">
                            <label class="col-form-label" for="infected_montenegro">Broj zaraženih u Crnoj Gori *</label>
                            <input id="infected_montenegro" class="form-control" type="number" placeholder="Broj zaraženih u Crnoj Gori" name="infected_montenegro">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12"> 
                        <div class="form-group">
                            <label class="col-form-label" for="infected_global">Broj zaraženih u Crnoj Gori *</label>
                            <input id="infected_global" class="form-control" type="number" placeholder="Broj zaraženih u Crnoj Gori" name="infected_global">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12"> 
                        <div class="form-group">
                            <label class="col-form-label" for="under_watch">Broj osoba pod nadzorom *</label>
                            <input id="under_watch" class="form-control" type="number" placeholder="Broj osoba pod nadzorom" name="under_watch">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12"> 
                        <div class="form-group">
                            <label class="col-form-label" for="tested">Broj zaraženih u Crnoj Gori *</label>
                            <input id="tested" class="form-control" type="number" placeholder="Broj zaraženih u Crnoj Gori" name="tested">
                        </div>
                    </div>
                </div>
                




		</div>
    </div>
        
@endsection

@endsection
