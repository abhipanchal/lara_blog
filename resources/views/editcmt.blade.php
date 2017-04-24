@extends('layoutnew')

@section('title')
    Blog List
@stop

@section('content')
    <script type="text/javascript" src="{{ asset('/js/moment.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js') }}" ></script>
    <div class="container">
        <div class="starter-template">
            <h1>ADD POST</h1>
        </div>
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
                <form action="{{ url('savecmt') }}" method="POST" enctype="multipart/form-data" role="form" data-toggle="validator">
                        <fieldset class="form-group">
                            <label >Enter Comment</label>
                            <input type="text" name="comment_data" class="form-control"  placeholder="Enter Comment" required value="{{ $comment->comment_data }}" >
                            <input type="hidden" name="comment_id" class="form-control"  placeholder="Enter Comment" required value="{{ $comment->comment_id }}" hidden>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@stop