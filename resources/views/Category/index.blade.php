@extends('layouts.apphome')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6 text-center mt-5">
		<h3 >List of categories</h3>	

		<ul class="list-group list_category">

		</ul>
		</div>
		<div class="col-md-6 text-center mt-5">
		<h3>Categories</h3>
		<ul class="list-group  allcategory">
			@foreach($category as $cate)
			<li class='list-group-item'>{{$cate->name}}</li>
			@endforeach
		</ul>
		</div>
		<div class="col-md-12">
			<form>
			  
			  <div class="form-group"> 
			    <label for="exampleInputPassword1">Enter Category Name</label>
			    <textarea class="form-control category" id="exampleInputPassword1" placeholder="Password"></textarea>
			    <span class="category-error" style="color: red;"></span>
			  </div>
			  
			  <button type="button" class="btn btn-primary save_data">Add</button>
			  <button type="button" class="btn btn-primary save_all">Save All</button>
			</form>
		</div>
	</div>
</div>

@endsection
@section('scripts')
<script src="{{asset('js/category.js')}}"></script>
@endsection
		
