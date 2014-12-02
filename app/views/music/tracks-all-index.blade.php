@extends('layouts.master')

@section('title')Tracks @stop

@section('body-title') Tracks
<div class="pull-right">
    {{ Form::open(array('route' => 'music-tracks-all', 'method' =>'post', 'role' =>'form', 'class' => 'form-horizontal')) }}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    {{ Form::text('search', null, ['placeholder' => 'Search', 'class' => 'form-control']) }}
                                    <span class="input-group-btn">
                                        {{ Form::submit('Search!', ['class' => 'btn btn-success']) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        {{ Form::token()}}
                        {{ Form::close()}}

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
                 <div class="action-buttons">

                <a href="#" class="delete" title="Delete record"> 
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                    </span>
                </a>
            </div>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ Paginator::setPageName('page') }}
{{ $tracks->appends(array('search' => Input::get('search', '')))->links() }}

@stop