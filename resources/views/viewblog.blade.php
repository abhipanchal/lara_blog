@extends('layout')

@section('title')
   ViewBlog
@stop

@section('content')
    <div class="col-md-8">


        <h1 class="page-header">
            Welcome
            <small>to AP Blog</small>
        </h1>

         @foreach($data as $value)


        <h2>
            <a href="viewmore.blade.php?post_id={{$value->post_id}}">{{$value->post_title}}</a>
        </h2>
        <p class="lead">
            by <a href="{{url('/')}}"> {{$value->user_name}}</a>
        </p>

        <p><span class="glyphicon glyphicon-time"></span> Posted on {{$value->post_create_date}}</p>

        {{ wordwrap($value['post_data'],50,"\n",true)}};
            <br>
            Total Comment-> {{$value->comments->count()}};
        </p>


        <a class="btn btn-primary" href="{{url('viewmore/'.$value->post_id)}}">Read More <span
                    class="glyphicon glyphicon-chevron-right"></span></a>
        <hr>
        @endforeach

        <center>
                <?php echo $data->render(); ?>
        </center>
</div>
@stop