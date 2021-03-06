@extends('layouts.master')

@section('title')Tracks @stop

@section('body-title') Tracks
<div class="pull-right">
    <a href="#newArtist" class="btn btn-circle green-haze" data-toggle="modal" title="Add New Artist"> 
        <i class="fa fa-plus"></i>
        <span class="hidden-480">Add Track</span>
    </a>
</div> @stop
@section('content')

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Track Name</td>
            <td>Album</td>
            <td>Artist</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($tracks as $track)
        <tr>
            <td>{{ $track->track_name }}</td>
            <td>{{ $track->album_name }}</td>
            <td>{{ $track->artist_name }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>
                {{ Form::open(['id' => 'frmPos' . $track->id, 'url' => '/music/artists/'. $artist_id . '/albums/' . $album_id . '/tracks/delete/' . $track->id, 'method' => 'POST']) }}

                <div class="action-buttons">
                    <a href="#" class="edit" title="Edit Track" track-id="{{ $track->id }}" > 
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>


                <a href="javascript:document.getElementById('frmPos{{ $track->id }}').submit();" class="delete" title="Delete record"> 
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
{{ $tracks->links() }}

<form action="{{ URL::route('music-tracks', array('artist_id' => $artist_id, 'album_id' => $album_id)) }}" method="post" class="form-horizontal" role="form">

    <div id="newArtist" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Albums</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Artist Name:</label>
                        <div class="col-md-9">
                            <input placeholder="" class="form-control" readonly="" type="text" value="{{ $artist_name }}">

                    <!--<span class="help-block">
                    A block of help text. </span>-->
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Album Name:</label>
                <div class="col-md-9">
                    <input placeholder="" class="form-control" readonly="" type="text" value="{{ $album_name }}">

                    <!--<span class="help-block">
                    A block of help text. </span>-->
                </div>
            </div>


            <div class="form-group {{ ($errors->has('name'))? 'has-error' : '' }}">
                <label class="col-md-3 control-label">Track Name:</label>
                <div class="col-md-9">
                    <input placeholder="Name of the track(song)" class="form-control" required="" name="name" type="text">

                    <!--<span class="help-block">
                    A block of help text. </span>-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>

            </div>
        </div>
    </div>
</div>
</div>
{{ Form::token() }}
{{ Form::close() }}

<form id="frmEdit" action="{{ URL::route('music-tracks', array('artist_id' => $artist_id, 'album_id' => $album_id)) }}" method="post" class="form-horizontal" role="form">

    <div id="editAlbum" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Albums</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-md-3 control-label">Artist Name:</label>
                        <div class="col-md-9">
                            <input id="txtArtistName" placeholder="" class="form-control" readonly="" type="text" value="{{ $artist_name }}">

                    <!--<span class="help-block">
                    A block of help text. </span>-->
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Album Name:</label>
                <div class="col-md-9">
                    <input id="txtAlbumName" placeholder="" class="form-control" readonly="" type="text" value="{{ $album_name }}">

                    <!--<span class="help-block">
                    A block of help text. </span>-->
                </div>
            </div>


            <div class="form-group {{ ($errors->has('name'))? 'has-error' : '' }}">
                <label class="col-md-3 control-label">Track Name:</label>
                <div class="col-md-9">
                    <input id="txtName" placeholder="Name of the track(song)" class="form-control" required="" name="name" type="text">

                    <!--<span class="help-block">
                    A block of help text. </span>-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>

            </div>
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
        var artist_id = $(this).attr('track-id');


        var url = "{{ url('music/api/tracks/get/')}}" + "/" + artist_id;
        $.get(url, function(data) {
            $('#txtArtistName').val(data.artist_name);
            $('#txtAlbumName').val(data.album_name);
            $('#txtName').val(data.name);

            var url = $('#frmEdit').attr('action') + "/" + data.id;


            $('#frmEdit').attr('action', url );

        });


        $("#editAlbum").modal('show');
    });
})
</script>

@stop