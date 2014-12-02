@extends('layouts.master')

@section('title')Albums @stop

@section('body-title') Albums
<div class="pull-right">
    {{ Form::open(array('route' => 'music-albums-all', 'method' =>'post', 'role' =>'form', 'class' => 'form-horizontal')) }}
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

</div>
 @stop
@section('content')

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Album Name</td>
            <td>Artist</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($albums as $album)
        <tr>
            <td>{{ $album->album_name }}</td>
            <td>{{ $album->artist_name }}</td>

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
{{ $albums->appends(array('search' => Input::get('search', '')))->links() }}


@stop