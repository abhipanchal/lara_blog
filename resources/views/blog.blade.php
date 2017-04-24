@extends('layoutnew')

@section('title')
		Blog List
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
					<form method="POST" action="{{url('postsearch')}}">
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
			<table class="table table-bordered" >
				<thead>
				<tr>
					<th>NAME</th>
					<th>POST TITLE</th>
					<th>DESCRIPTION</th>
					<th>Image</th>
					<th colspan="2">ACTION</th>
				</tr>
				</thead>
				<tbody>
				@foreach($data as $p)
					<tr>
						<td>{{$p->user_name}}</td>
						<td>{{$p->post_title}}</td>
						<td>{{wordwrap($p->post_data,'20','\n',true)}}</td>
						<td><img src="uploads/{{$p->post_image}}"  width="50" height="50" ></td>
						<td>
							<a href="editpost/{{$p->post_id}}">Edit</a>
							<a href="deletepost/{{$p->post_id}}"  onclick="return confirm('Are You Sure You Want to delete ?');">Delete</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>

			<?php echo $data->render(); ?>
		</div>
	</div>
	@stop