@extends('layouts.apphome')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center mt-5">
		<h3 style="ma">List of Article</h3>	
		</div>
		    <!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-primary " data-toggle="modal" data-target="#exampleModal" style="float:right;">
  Add
</button>
		<div class="col-md-12">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Title</th>
			      <th scope="col">Description</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody class="tbody">
			  	@foreach($user as $key=>$value)
			  	<tr class="row{{$value->id}}">
			      <td>{{$value->title}}</td>
			      <td>{{$value->description}}</td>
			      <td><button class="btn btn-primary ml-1 mr-1 edit" data-id="{{$value->id}}" data-toggle="modal" data-target="#exampleModal1" style="margin-right: 2px;">Edit</button><button class="btn btn-danger ml-1 mr-1 delete" data-id="{{$value->id}}">Delete</button></td>
			    </tr>
			  	@endforeach
			    
			  </tbody>
			</table>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Enter Title</label>
			    <input type="text" class="form-control title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
			    <span class="title-error" style="color: red;"></span>
			  </div>
			  
			  <div class="form-group"> 
			    <label for="exampleInputPassword1">Enter Description</label>
			    <textarea class="form-control description" id="exampleInputPassword1" placeholder="Password"></textarea>
			    <span class="description-error" style="color: red;"></span>
			  </div>
			  
			  <button type="button" class="btn btn-primary submit_form">Submit</button>
			</form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Update Title</label>
			    <input type="text" class="form-control edit_title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
			    <span class="title-error" style="color: red;"></span>
			  </div>
			  
			  <div class="form-group"> 
			    <label for="exampleInputPassword1">Update Description</label>
			    <textarea class="form-control edit_description" id="exampleInputPassword1" placeholder="Password"></textarea>
			    <span class="description-error" style="color: red;"></span>
			  </div>
			  
			  <button type="button" class="btn btn-primary update_submit_form" data-id="">Update</button>
			</form>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		//Edit Functionality
		$(document).on('click','.edit',function(){

			id = $(this).data('id');
			//alert(id);
			$.ajax({
				     url: "{{route('article.edit',"+id+")}}",
				     method: 'GET',
				     data:{
				     	id:id,
				     	"_token": "{{ csrf_token() }}",
				     },
				     type:"json",
				     success: function(response)
				     {
				       if(response.status == 1)
				       {
				       	
				       	console.log(response);
				       	$(".edit_title").val(response.data.title)
				       	$(".edit_description").val(response.data.description);
				       	$('.update_submit_form').attr('data-id',response.data.id);
				         
				       }
				     },
				     error:function()
				     {
				     		console.log("hello");
				     }
				});

		})
		//End

		$(document).on('click','.delete',function(){

			id = $(this).data('id');
			$.ajax({
				     url: "{{route('article.destroy',"+id+")}}",
				     method: 'delete',
				     data:{
				     	id:id,
				     	"_token": "{{ csrf_token() }}",
				     },
				     type:"json",
				     success: function(response)
				     {
				       if(response.status == 1)
				       {
				       	
				       	$(".row"+response.id).remove();
				         
				       }
				     },
				     error:function()
				     {
				     		console.log("hello");
				     }
				});

		})
		$(document).on('click',".submit_form", function(){
			title = $(".title").val();
			desc = $(".description").val();
			// alert(title);
			// alert(desc);
			if(title == "" || title == undefined){
				$(".title-error").html('Please Enter Title');
			}else{
				$(".title-error").html('');
			}
			if(desc == "" || desc == undefined){
				$(".description-error").html('Please Enter Description');
			}else{
				$(".description-error").html('');
			}

			if(title != "" && desc != ""){
				$.ajaxSetup({headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`). attr("content")}});
				$.ajax({
				     url: "{{route('article.store')}}",
				     method: 'POST',
				     data:{
				     	title:title,
				     	desc:desc,
				     	"_token": "{{ csrf_token() }}",
				     },
				     type:"json",
				     success: function(response)
				     {
				       if(response.status == 1)
				       {
				       	$(".title").val("");
						$(".description").val("");
				       	html = "<tr class='"+response.data.id+"'><td>"+response.data.title+"</td><td>"+response.data.description+"</td>";
				       	html+="<td><button class='btn btn-primary ml-1 mr-1 edit' data-id="+response.data.id+" style='margin-right: 2px;'>Edit</button><button class='btn btn-danger ml-1 delete mr-1' data-id="+response.data.id+">Delete</button></td></tr>";
				         $(".tbody").append(html);
				         $('#exampleModal').modal('hide');
				         
				       }
				     },
				     error:function()
				     {
				     		console.log("hello");
				     }
				});
			}
		})


		//Update Data

		$(document).on('click',".update_submit_form", function(){
			title = $(".edit_title").val();
			desc = $(".edit_description").val();
			id = $(this).data('id');
			// alert(title);
			// alert(desc);
			if(title == "" || title == undefined){
				$(".edit_title-error").html('Please Enter Title');
			}else{
				$(".edit_title-error").html('');
			}
			if(desc == "" || desc == undefined){
				$(".edit_description-error").html('Please Enter Description');
			}else{
				$(".edit_description-error").html('');
			}

			if(title != "" && desc != ""){
				$.ajaxSetup({headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`). attr("content")}});
				$.ajax({
				     url: "{{route('article.update',"+id+")}}",
				     method: 'PUT',
				     data:{
				     	title:title,
				     	desc:desc,
				     	id:id,
				     	"_token": "{{ csrf_token() }}",
				     },
				     type:"json",
				     success: function(response)
				     {
				       if(response.status == 1)
				       {

				       	html = "<td>"+response.data.title+"</td><td>"+response.data.description+"</td>";
				       	html+="<td><button class='btn btn-primary ml-1 mr-1 edit' data-id="+response.data.id+" style='margin-right: 2px;'>Edit</button><button class='btn btn-danger ml-1 delete mr-1' data-id="+response.data.id+">Delete</button></td>";
				       	$(".row"+id).html(html);
				       	$('#exampleModal1').modal('hide');
				         
				       }
				     },
				     error:function()
				     {
				     		console.log("hello");
				     }
				});
			}
		})
		//End
	})
</script>
@endsection
		
