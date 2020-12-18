	$(document).ready(function(){
		html = "";
		ca = [];
        if(sessionStorage.getItem('category') != "" && sessionStorage.getItem('category') != null){
        	sessionStorage.getItem('category').split(',').forEach(r => {
			html += "<li class='list-group-item'>"+r+"</li>";
		});
        	ca.push(sessionStorage.getItem('category'));
        }
        $(".list_category").html(html);
		$(document).on('click','.save_data',function(){
			category = $(".category").val();
			
			if(category == ""){
				$(".category-error").html("Please Enter Category value");
			}else{
				$(".category-error").html("");
				if(sessionStorage.getItem('category') == null){
					ca = [];
				}
				ca.push(category);
				sessionStorage.setItem('category',ca);
				val = sessionStorage.getItem('category');
				html = "";
				if(val != null){
					val.split(',').forEach(r => {
					html += "<li  class='list-group-item'>"+r+"</li>";
				});
				$(".list_category").html(html);
				$(".category").val("");
				}
        		
			}
			
		})

		$(document).on('click','.save_all',function(){
			val = sessionStorage.getItem('category');
			$.ajax({
				     url: "{{route('category.store')}}",
				     method: 'POST',
				     data:{
				     	val:val,
				     	"_token": "{{ csrf_token() }}",
				     },
				     type:"json",
				     success: function(response)
				     {
				       if(response.status == 1)
				       {
				       	sessionStorage.clear();
				       	console.log(sessionStorage.getItem('category'));
				       	html = "";
						response.data.forEach(r => {
							html += "<li  class='list-group-item'>"+r.name+"</li>";
						});
						$(".allcategory").html(html);
						$(".list_category").html("");
						$(".category").val("");
				   }
				     },
				     error:function()
				     {
				     	console.log("hello");
				     }
				});
		})
	})