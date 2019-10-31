$(document).ready(function(){
    $.ajax({
		type : "GET",
		cache: false,
		// contentType : "application/json",//type of data being send to server
		url : "/mainsite/fetch/Electronics/"+page,
		// data : JSON.stringify({email: $("#email").val()}),
		
		dataType : "json",//result expected from server
						//with json return type we can return java objects
						//With text we can return String from java conroller
		timeout : 100000,
		success : function(blogList) {
			
			console.log(blogList);
			if(blogList.length != 0){
				var blog_container = document.getElementsByClassName("nospace group")[4];
				
		
				for(i=0; i<blog_container.childElementCount-1; i++){
					blog_container.removeChild(blog_container.children[i]);
				}
				
				for(i=0; i<blogList.length; i++){
					
						var blog = blogList[i];
						
						var container = document.createElement("li");
						container.setAttribute("class","one_third first");
						
						
						var blogTemplate='<article class="excerpt"><a href="#"><img class="inspace-10 borderedbox" src="../img/images/demo/320x220.png" alt=""></a>'+
                          '<div class="excerpttxt">'+
                            '<ul>'+
                              '<li><i class="fa fa-calendar-o"></i>'+ blog.date +'</li>'+
                              '<li><i class="fa fa-comments"></i> <a href="#">'+blog.claps+'</a></li>'
                            '</ul>'+
                            '<h6 class="heading font-x1">'+blog.title+'</h6>'+
                            '<p><a class="btn" href="#">Read More</a></p>'+
                          '</div>'
                        '</article>';
                      
					container.innerHTML= blogTemplate;
					blog_container.insertBefore(blog_container,blog_container.childNodes[0]);

				}
		
			}

		},
		error : function(e) {
			console.log("ERROR: ", e);
		},
		complete : function(e) {
			
		}
	});
})