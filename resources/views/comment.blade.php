@extends('layoutnew')

@section('title')
    Comment List
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
        <div class="starter-template">
            <h3> Welcome {{$name}} </h3>
            <div class="row">
                <div class="col-lg-6">
                    <form method="POST" action="{{url('cmtsearch')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for..." name="search">
							<span class="input-group-btn">
							<button class="btn btn-default" type="submit">Go!</button>

					</span>

                        </div><!-- /input-group -->
                    </form>
                </div><!-- /.col-lg-6 -->
            </div>
            <br>
            <div class="row">
                <form action="deletecmt" method="post">

                    <input type="submit" value="Delete All">

                            <table class="table table-bordered" >
                                <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Id</th>
                                    <th>DESCRIPTION</th>
                                    <th colspan="2">ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $p)
                                    <tr>
                                        <td> <input type="checkbox" name="check[]" value="{{$p->comment_id}}"> </td>
                                        <td>{{$p->comment_id}}</td>
                                        <td>{{wordwrap($p->comment_data,'20','\n',true)}}</td>
                                        <td>
                                            <a href="editcmt/{{$p->comment_id}}">Edit</a> |
                                            <a href="deletecmt/{{$p->comment_id}}"  onclick="return confirm('Are You Sure You Want to delete ?');">Delete</a> |
                                            <a href="status/{{$p->comment_id}}/@if($p->is_approve==0){{'1'}}@else{{'0'}}@endif" >
                                                @if($p->is_approve==0)
                                                    {{'Active'}}
                                                @else
                                                    {{'DeActive'}}
                                                @endif

                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                </form>
                <?php echo $data->render(); ?>
            </div>
        </div>

@stop