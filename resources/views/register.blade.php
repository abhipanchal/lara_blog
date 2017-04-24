@extends('layout')
@section('title')
    Login
@stop
@section('content')
    <div class="container" style="width:50%;">
        @if(count($errors)>0)
                <div class="alert alert-danger msg">
                    <uL>
                        @foreach($errors->all() as $er)
                                <li>{{$er}}</li>
                        @endforeach
                    </uL>
                </div>
        @endif
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
                    <form class="form-signin" action="{{url('register')}}" method="POST" role="form" data-toggle="validator">
                        <h2 class="form-signin-heading">Please Register</h2>
                        <div class="form-group">
                            <label for="fname" class="sr-only">First Name</label>
                            <input type="text" id="fname" name="fname" class="form-control" placeholder="first name" required autofocus value="{{old('fname')}}"><br>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="lname" class="sr-only">Last Name</label>
                            <input type="text" id="lname" name="lname" class="form-control" placeholder="last name" required ><br>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="sr-only">Email address</label>
                            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required ><br>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">

                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required ><br>
                            <div class="help-block with-errors"></div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Register </button><br>
                    </form>
                    <a href="{{url('/')}}" ><button class="btn btn-lg btn-primary btn-block" >Login</button></a>
                </div>
            </div>
    </div>
@stop