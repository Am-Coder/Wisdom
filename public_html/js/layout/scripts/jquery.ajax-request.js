$(document).ready(function(){
	
	$(".loader").hide();
	
	fetchInfo(0);
	$('#scifiBlogs').click(function(event){
		event.preventDefault();
		fetchInfo(0, 'scifi');
	})

	$('#artBlogs').click(function(event){
		event.preventDefault();
		fetchInfo(0, 'art');
	})

	$('#managementBlogs').click(function(event){
		event.preventDefault();
		fetchInfo(0, 'management');
	})

	$('#researchBlogs').click(function(event){
		event.preventDefault();
		fetchInfo(0, 'research');
	})

	$('#moreBlogs').click(function(event){
		event.preventDefault();
		fetchInfo(0, 'all');
	})

	$('#myBlog').click(function(event){
		event.preventDefault();
		fetchInfo(0, 'me');
	})
})

function fetchInfo( page, type='all' ){

		$('.loader').show();
    $.ajax({
		type : "GET",
		cache: false,
		// contentType : "application/json",//type of data being send to server
		url : "fetchBlog.php?page="+page+"&type="+type,
		// data : JSON.stringify({email: $("#email").val()}),
		
		dataType : "json",//result expected from server
						//with json return type we can return java objects
						//With text we can return String from java conroller
		timeout : 10000,
		success : function(blogList) {
            
      console.log("V-V");
			console.log(blogList);

			var blog_container = document.getElementsByClassName('nospace group')[1];
			console.log(blog_container.childElementCount)
			var len = blog_container.childElementCount;
			for(i=0; i<len; i++){
				blog_container.removeChild(blog_container.children[0]);
			}			

			if(blogList.length != 0 && blogList ){

				
				for(i=0; i<blogList.length; i++){
					
						var blog = blogList[i];
						
						var container = document.createElement("li");
						container.setAttribute("class","one_third first");
						container.style.cssFloat="inline-end";
						
						var blogTemplate='<article class="excerpt"><a href="#"><img class="inspace-10 borderedbox" src='+blog.imagetoshow+' alt="" style="width:250px; height:280px"></a>'+
                          '<div class="excerpttxt">'+
                            '<ul>'+
                              '<li><i class="fa fa-calendar-o"></i>'+ blog.datepublished +'</li>'+
                              '<li><i class="fa fa-thumbs-o-up"></i> <a href="#">'+blog.claps+'</a></li>'+
                            '</ul>'+
                            '<h6 class="heading font-x1">'+blog.title+'&hellip;</h6>'+
                            '<p><a class="btn" href="#" id='+blog.blogid+'>Read More</a></p>'+
                          '</div>'+
                        '</article>';
                      
                    container.innerHTML= blogTemplate;
                    blog_container.append(container);
					// blog_container.insertBefore(container,blog_container.childNodes[0]);

				}
		
			}else{
				var container = document.createElement("div");
				container.innerHTML = "<h1 style='color:red'> Sorry, could not find any blog </h1>";
				blog_container.append(container);

			}

		},
		error : function(e) {
			console.log("ERROR: ", e);
			var container = document.createElement("div");
			$(".loader").hide();
			container.innerHTML = "<h1 style='color:red'> Could not fetch blogs, Some error occured </h1>";
			blog_container.append(container);
		},
		complete : function(e) {
			$(".loader").hide();
		}
	});
}