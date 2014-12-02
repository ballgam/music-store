@extends('account.master')

@section('title')Register
@stop

@section('content')
<div id="signupbox" style="display:block; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Sign Up</div>
        </div>  
        <div class="panel-body" >
            {{ print_r($errors) }} 
            @if(Session::has('message'))
                    @if(Session::has('type'))
                        <!--TODO Remove thr pring error. Only to be used for debugging-->
                       
                        <div class="alert alert-{{Session::get('type')}}" role="alert">{{ Session::get('message') }}</div>
                    @else
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                    @endif
            @endif
            {{ Form::open(['role' => 'form', 'class' => 'form-horizontal']) }}


            <div id="signupalert" style="display:none" class="alert alert-danger">
                <p>Error:</p>
                <span></span>
            </div>

            <div class="form-group {{ ($errors->has('username'))? 'has-error' : '' }}">
                {{ Form::label('username', 'Username', ['class' => 'col-md-3 control-label', 'for' => 'username' ]) }}
                <div class="col-md-9">
                    {{ Form::text('username', null, ['class' => 'form-control', 'required' => '']) }}
                </div>
            </div>
            
            <div class="form-group {{ ($errors->has('email'))? 'has-error' : '' }}">
                {{ Form::label('email', 'Email', ['class' => 'col-md-3 control-label', 'for' => 'email' ]) }}
                <div class="col-md-9">
                    {{ Form::text('email', null, ['type' => 'email', 'class' => 'form-control', 'required' => '']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password', ['class' => 'col-md-3 control-label', 'for' => 'password' ]) }}
                <div class="col-md-9">
                    {{ Form::text('password', null, ['type' => 'password', 'class' => 'form-control', 'required' => '']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('password_again', 'Confirm Password', ['class' => 'col-md-3 control-label', 'for' => 'password_again' ]) }}
                <div class="col-md-9">
                    {{ Form::text('password_again', null, ['type' => 'password', 'class' => 'form-control', 'required' => '']) }}
                </div>
            </div>

            <div class="form-group">
                <!-- Button -->                                        
                <div class="col-md-offset-3 col-md-9">
                    {{ Form::submit('Register', ['class' => 'btn btn-info']) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 control">
                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                        Already have an account? 
                        <a href="{{ route('account-login') }}" >
                            Click here to Login
                        </a>
                    </div>
                </div>
            </div>   


            {{ Form::token() }}
            {{ Form::close() }}
        </div>
    </div>
</div> 
@stop