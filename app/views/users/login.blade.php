@extends('layouts.full-screen-form')

@section('body')
<div class="full-screen-form">
  {{ Form::open(array('url' => 'login', 'class'=>'form-signin')) }}
  	<h2 class="form-signin-heading">Please sign in</h2>
    {{ Form::token() }}
    
    {{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Username')) }}
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}

    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
  {{ Form::close() }}
</div>
@stop
