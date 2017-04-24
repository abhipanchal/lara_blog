@extends('layoutnew')

@section('title')
    Blog List
@stop

@section('content')
    <script type="text/javascript" src="{{ asset('/js/moment.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js') }}" ></script>
    <div class="container">
        <div class="starter-template">
            <h1>@if(isset($data))
                       {{'Edit POST'}}
                @else
                        {{'Add POST'}}
                @endif</h1>

        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger msg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
            <div class="col-lg-6">
                <form action="@if(isset($data)){{url('addpost/'.$data->post_id)}} @else {{url('addpost')}} @endif" method="POST" enctype="multipart/form-data" role="form" data-toggle="validator">

                    <fieldset class="form-group">
                        <label >Enter Post Title</label>
                        <input type="text" name="post_title"  class="form-control"  placeholder="Enter Title" required value="@if(isset($data)){{$data->post_title}}@else{{old('post_title')}}@endif" >
                    </fieldset>

                    <fieldset class="form-group">
                        <label >Enter Post Description</label>
                        <textarea class="form-control" name="post_data" rows="3" required placeholder="Enter Description">@if(isset($data)){{$data->post_data}}@else{{ old('post_data')}}@endif</textarea>
                    </fieldset>

                    <fieldset class="form-group">
                        <label>File input</label>
                        @if(isset($data))
                            <img src="{{url('uploads/'.$data->post_image)}}" width="50" height="50">
                        @endif
                        <input type="file" name="post_image" class="form-control-file form-control" @if(!isset($data)){{ 'required' }} @endif style="padding-bottom: 35px;">
                    </fieldset>

                    <div class="row">
                        <div class='col-sm-6'>
                            <div>
                                <span>Select Expiry Date</span>
                            </div>
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" name="post_date" value="@if(isset($data)){{$data->post_expire_date}}@else{{ old('post_date')}}@endif" required/>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                                </div>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(function () {
                                $('#datetimepicker1').datetimepicker({
                                    format: 'YYYY-MM-DD HH:mm:ss'
                                });
                            });
                        </script>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@stop