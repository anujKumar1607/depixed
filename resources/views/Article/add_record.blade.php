@extends('layouts.apphome')
@section('content')
		<div class="container">
			<div class="row main">
				<div class="row">
					 @if(session()->has('message'))
			              <div class="alert alert-success">
			                  {{ session()->get('message') }}
			              </div>
			          @endif
			           @if(session()->has('error'))
			              <div class="alert alert-danger">
			                  {{ session()->get('error') }}
			              </div>
			          @endif
				</div>
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">GM Modular</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('gmmodular.store')}}">
						@csrf
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Title</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="title" id="title"  placeholder="Enter your Title" value="{{ old('title') }}"/>
									 
								</div>
								@error('title')
				                   <p style="color:red;">{{$message}}</p>
				                @enderror
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<textarea class="form-control" name="description">{{ old('description') }}</textarea>
									
								</div>
								@error('description')
				                   <p style="color:red;">{{$message}}</p>
				                @enderror
							</div>
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Thumbnails</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="file" class="form-control" name="thumbnail" id="thumbnail"  placeholder="Select Your File" accept="image/*"  value="{{ old('thumbnail') }}" />
								</div>
								@error('thumbnail')
				                   <p style="color:red;">{{$message}}</p>
				                @enderror
							</div>
						</div>


						<div class="form-group ">
							<button type="submit" class="btn btn-primary btn-lg btn-block login-button">Submit</button>
						</div>

					</form>
				</div>
			</div>
		</div>
@endsection

		
