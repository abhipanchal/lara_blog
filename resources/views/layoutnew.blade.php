<!doctype html>
<html>
<head>

    <title>@yield('title')</title>
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="{{ asset('/js/validator.js') }}"></script>

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">AP BLOG</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{url('post')}}">Home</a></li>
                <li><a href="{{url('addpost')}}">Add Post</a></li>
                <li><a href="{{url('comment')}}">comment</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@yield('content')
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $(".msg").fadeOut(8000);
    });
</script>
</body>
</html>