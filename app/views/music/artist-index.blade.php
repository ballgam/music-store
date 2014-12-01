@extends('layouts.master')

@section('title')Artists @stop

@section('body-title') Artists 
<div class="pull-right">
	<a href="#newArtist" class="btn btn-circle green-haze" data-toggle="modal" title="Add New Artist"> 
		<i class="fa fa-plus"></i>
		<span class="hidden-480">New Artist</span>
	</a>
</div>
@stop
@section('content')

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td></td>
			<td>Name</td>
			<td>About</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
		@foreach($artists as $artist)
		<tr>
			<td><a href="{{ URL::route('music-albums', array('artist_id' => $artist->id)) }}">View Albums</a></td>
			<td>{{ $artist->name }}</td>
			<td>{{ $artist->about }}</td>

			<td>

				{{ Form::open(['id' => 'frmPos' . $artist->id, 'url' => '/music/artists/delete/' . $artist->id, 'method' => 'POST']) }}

				<div class="action-buttons">
					<a href="#" class="edit" title="Edit Artist" artist-id="{{ $artist->id }}" > 
						<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
						</span>
					</a>


				<a href="javascript:document.getElementById('frmPos{{ $artist->id }}').submit();" class="delete" title="Delete record"> 
					<span class="fa-stack fa-lg">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
					</span>
				</a>
			</div>
			{{ Form::token() }}
			{{ Form::close() }}

		</td>
	</tr>
	@endforeach
</tbody>
</table>
{{ $artists->links() }}

<form action="{{ URL::route('music-artist') }}" method="post" class="form-horizontal" role="form">

	<div id="newArtist" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">New Artist</h4>
				</div>
				<div class="modal-body">

					<div class="form-group {{ ($errors->has('name'))? 'has-error' : '' }}">
						<label class="col-md-3 control-label">Artist Name:</label>
						<div class="col-md-9">
							{{ Form::text('name', null, ['placeholder' => 'Name of the artist', 'class' => 'form-control', 'required' => '']) }}

					<!--<span class="help-block">
					A block of help text. </span>-->
				</div>
			</div>


			<div class="form-group {{ ($errors->has('about'))? 'has-error' : '' }}">
				<label class="col-md-3 control-label">About</label>
				<div class="col-md-9">
					{{ Form::textarea('about', null, ['placeholder' => 'Brief description of the artist', 'class' => 'form-control', 'required' => '', 'rows' => '3' ]) }}

					<!--<span class="help-block">
					A block of help text. </span>-->
				</div>
			</div>


		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Save changes</button>

		</div>
	</div>
</div>
</div>
{{ Form::token() }}
{{ Form::close() }}


<form id="frmEdit" action="{{ URL::route('music-artist') }}" method="post" class="form-horizontal" role="form">
	<div id="editArtist" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Edit Artist</h4>
				</div>
				<div class="modal-body">

					<div class="form-group {{ ($errors->has('name'))? 'has-error' : '' }}">
						<label class="col-md-3 control-label">Artist Name:</label>
						<div class="col-md-9">
							{{ Form::text('name', null, ['id' => 'txtName', 'placeholder' => 'Name of the artist', 'class' => 'form-control', 'required' => '']) }}

					<!--<span class="help-block">
					A block of help text. </span>-->
				</div>
			</div>


			<div class="form-group {{ ($errors->has('about'))? 'has-error' : '' }}">
				<label class="col-md-3 control-label">About</label>
				<div class="col-md-9">
					{{ Form::textarea('about', null, ['id' => 'txtAbout', 'placeholder' => 'Brief description of the artist', 'class' => 'form-control', 'required' => '', 'rows' => '3' ]) }}

					<!--<span class="help-block">
					A block of help text. </span>-->
				</div>
			</div>


		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Save changes</button>

		</div>
	</div>
</div>
</div>
{{ Form::token() }}
{{ Form::close() }}


@stop

@section('script')
<script type="text/javascript">
$(document).ready(function(){
	$('.edit').click(function(){
		var artist_id = $(this).attr('artist-id');


		var url = "{{ url('music/api/artists/get/')}}" + "/" + artist_id;
		$.get(url, function(data) {
				//$("input:checkbox[class=cbUserRoles:checked").each(function()
					$('#txtName').val(data.name);
					$('#txtAbout').val(data.about);

					var url = "{{ url('music/artists/') }}" + "/" + data.id;

					$('#frmEdit').attr('action', "{{ url('music/artists/') }}" + "/" + data.id )
					
				});


		$("#editArtist").modal('show');
	});
})
</script>

@stop