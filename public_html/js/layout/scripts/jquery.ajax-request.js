$(document).ready(function(){
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

})

function fetchInfo( page, type='all' ){
    $.ajax({
		type : "GET",
		cache: false,
		// contentType : "application/json",//type of data being send to server
		url : "fetchBlog.php?page="+page+"&type="+type,
		// data : JSON.stringify({email: $("#email").val()}),
		
		dataType : "json",//result expected from server
						//with json return type we can return java objects
						//With text we can return String from java conroller
		timeout : 100000,
		success : function(blogList) {
            
      console.log("V-V");
			console.log(blogList);

			var blog_container = document.getElementsByClassName('nospace group')[1];
			console.log(blog_container.childElementCount)
			var len = blog_container.childElementCount;
			for(i=0; i<len; i++){
				blog_container.removeChild(blog_container.children[0]);
			}			

			if(blogList.length != 0){

				
				for(i=0; i<blogList.length; i++){
					
						var blog = blogList[i];
						
						var container = document.createElement("li");
						container.setAttribute("class","one_third first");
						
						
						var blogTemplate='<article class="excerpt"><a href="#"><img class="inspace-10 borderedbox" src='+blog.imagetoshow+' alt=""></a>'+
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
		
			}

		},
		error : function(e) {
			console.log("ERROR: ", e);
		},
		complete : function(e) {
			
		}
	});
}