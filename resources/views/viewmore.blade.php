@extends('layout')

@section('title')
    View Comment
@stop

@section('content')
<div class="container">
     @if(Session::has('message'))
         <div class="row">
             <div class="">
                 <div class="alert {{ Session::get('alert-class', 'alert-info') }} msg">
                     {{ Session::get('message') }}
                 </div>
             </div>
         </div>
     @endif


 <div class="col-md-8">
        <h1 class="page-header">
            Welcome
            <small>to AP Blog</small>
        </h1>
    <h2>
        <h4><b>Title:</b><a href="#">{{ $data->post_title }}</a></h4>

    </h2>
    <p class="lead">
        by <a href="index.php">{{ $data->user_name }}</a>
    </p>




    <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $data->post_create_date }}</p>


    <img class="img-responsive" src="{{url('uploads/'.$data->post_image)}}" alt="">

    <h4><b>Description:</b></h4>
        <p>
             {{ $data->post_data }}
        </p>

    <hr>


    <aside class="comments" id="comments">
        <h2><i class="fa fa-comments"></i>{{ $data->comments->count() }}  Comments</h2>
        <hr>
        @foreach($data->comments as $v)
         <article class="comment" data-val="{{$v->comment_id}}">
            <header class="clearfix">
                <div class="meta">
                    <h3><a href="#">{{ $v->username }}</a></h3>
                    <input type="hidden" value="{{$v->comment_id}}" class="parent">
                    <a href="#create-comment" class="reply-link">Reply</a>
                </div>
            </header>
                <div class="body">
                    {{$v->comment_data}}
                </div>
        </article>


        @foreach($v->reply as $v2)
        <article class="comment reply" style=" margin-left: 100px;">
                <header class="clearfix">
                    <div class="meta">
                        <h3><a href="#">{{$v2->username }}</a></h3>
                        <input type="hidden" value="{{$v2->reply_id}}" class="parent">
                        <a href="#create-comment" class="reply-link">Reply</a>
                    </div>
                </header>
                <div class="body">
                    {{$v2->comment_data}}
                </div>
        </article>
        @endforeach

        @endforeach
    </aside>

    <aside class="create-comment" id="create-comment">
        <hr>
        <h2><i class="fa fa-heart"></i> Add Comment</h2>
        <form action="{{url('addcomment')}}" method="POST" accept-charset="utf-8">
            <input type="text" name="username" required placeholder="Username" class="form-control input-lg" id="username">
            <input type="hidden" name="post_id" value="{{$data->post_id}}"  id="post_id">
            <input type="hidden" name="reply_id" value="0" id="reply_id">
            <textarea rows="10" name="comment_data" id="comment-body" placeholder="Your thoughts..." class="form-control input-lg" required></textarea>
            <div class="buttons clearfix">
                <button type="reset"  class="btn btn-xlarge btn-tales-one">Cancel</button>
                <button type="button" class="btn btn-xlarge btn-tales-one" id="submit">Submit</button>
            </div>
        </form>
    </aside>
 </div>
 </div>

 <script>
     $(document).ready(function(){

         $('.reply-link').click(function(e){
             $('#reply_id').val($(this).parent().find('.parent').val());
         });

         $('#submit').click(function(){
                var post_id=$('#post_id').val();
                var reply_id=$('#reply_id').val();
                var  username=$('#username').val();
                var body=$('#comment-body').val();

             if(username.length==0 || body.length == 0)
             {
                  alert("Username And Message Are Required");

             }else {
                 $.ajax({
                         url: '{{url('addcomment')}}',
                         method: "POST",
                         data: {'username': username, 'comment_data': body, 'post_id': post_id, 'reply_id': reply_id},
                         success: function (result) {

                             if (reply_id == 0) {
                                 str1 = '<article class="comment"';
                             }
                             else {
                                 str1 = '<article class="comment reply" style="margin-left: 100px;"';
                             }

                             var str = str1 +
                                     '<header class="clearfix">' +
                                     '<div class="meta">' +
                                     '<h3><a href="#">' + username + '</a></h3>' +
                                     '<input type="hidden" value="' + result + '" class="parent">' +
                                     '<a href="#create-comment" class="reply-link">Reply</a>' +
                                     '</div>' +
                                     '</header>' +
                                     '<div class="body">' +
                                     body +
                                     '</div>' +
                                     '</article>';
                             if (reply_id == 0)
                                 $('.comments').append(str);
                             else {
                                 //alert(reply_id);
                                 $(str).insertAfter($(".comments").find("article[data-val='" + reply_id + "']"));
                             }

                             alert("comment Inserted SuccessFully");
                             $('#username').val("");
                             $('#comment-body').val("");
                         }
                 });

             }
         });
});
</script>
@stop