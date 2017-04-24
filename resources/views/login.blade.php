@extends('layout')

@section('title')
        Login
@stop

@section('content')
<div class="container" style="width:50%;">

    @if(Session::has('message'))
        <div class="row">
            <div class="col-lg-6">
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }} msg">
                        {{ Session::get('message') }}
                    </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <form class="form-signin" action="login" method="POST" role="form" data-toggle="validator">

                {{--{!! Form::open(array('url' => 'login','method'=>'POST','class'=>'form-signin')) !!}--}}

                <h2 class="form-signin-heading">Please sign in</h2>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email"  name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                        <label for="inputPassword"  class="sr-only">Password</label>
                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        <div class="help-block with-errors"></div>
                    </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button><br>

                </form>
            <a href="{{url('register')}}" ><button class="btn btn-lg btn-primary btn-block" >Register</button></a><br>
            <a href="{{url('viewblog')}}" ><button class="btn btn-lg btn-primary btn-block" >View Blog</button></a>
            {{--{!! Form::close() !!}--}}
        </div>
    </div>
</div>
@stop