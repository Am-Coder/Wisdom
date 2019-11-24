$(document).ready(function(){

    var url = window.location.href;
    id = getAllUrlParams(url).blogid;
    console.log(url);
    console.log(getAllUrlParams(url));
    console.log(getAllUrlParams(url).blogid);
    var blog_container = document.getElementsByClassName('blogContent')[0];

    $('.loader').show();
    $.ajax({
		type : "GET",
		cache: false,
		// contentType : "application/json",//type of data being send to server
		url : "displayBlog.php?id="+id,
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
						container.style.margin="10px";
						var blogTemplate='<article class="excerpt"><img class="inspace-10 borderedbox" src='+blog.imagetoshow+' alt="" style="width:250px; height:280px"></a>'+
                          '<div class="excerpttxt">'+
                            '<ul>'+
                              '<li><i class="fa fa-calendar-o"></i>'+ blog.datepublished +'</li>'+
                              '<li><i class="fa fa-thumbs-o-up"></i> <a href="#">'+blog.claps+'</a></li>'+
                            '</ul>'+
                            '<h6 class="heading font-x1">'+blog.title+'&hellip;</h6>'+
                            '<p><a class="btn btnBlog" href="pages/Display.html?blogId='+ blog.blogid+'" id='+blog.blogid+'>Read More</a></p>'+
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
 
})

function getAllUrlParams(url) {

    // get query string from url (optional) or window
    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
  
    // we'll store the parameters here
    var obj = {};
  
    // if query string exists
    if (queryString) {
  
      // stuff after # is not part of query string, so get rid of it
      queryString = queryString.split('#')[0];
  
      // split our query string into its component parts
      var arr = queryString.split('&');
  
      for (var i = 0; i < arr.length; i++) {
        // separate the keys and the values
        var a = arr[i].split('=');
  
        // set parameter name and value (use 'true' if empty)
        var paramName = a[0];
        var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];
  
        // (optional) keep case consistent
        paramName = paramName.toLowerCase();
        if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();
  
        // if the paramName ends with square brackets, e.g. colors[] or colors[2]
        if (paramName.match(/\[(\d+)?\]$/)) {
  
          // create key if it doesn't exist
          var key = paramName.replace(/\[(\d+)?\]/, '');
          if (!obj[key]) obj[key] = [];
  
          // if it's an indexed array e.g. colors[2]
          if (paramName.match(/\[\d+\]$/)) {
            // get the index value and add the entry at the appropriate position
            var index = /\[(\d+)\]/.exec(paramName)[1];
            obj[key][index] = paramValue;
          } else {
            // otherwise add the value to the end of the array
            obj[key].push(paramValue);
          }
        } else {
          // we're dealing with a string
          if (!obj[paramName]) {
            // if it doesn't exist, create property
            obj[paramName] = paramValue;
          } else if (obj[paramName] && typeof obj[paramName] === 'string'){
            // if property does exist and it's a string, convert it to an array
            obj[paramName] = [obj[paramName]];
            obj[paramName].push(paramValue);
          } else {
            // otherwise add the property
            obj[paramName].push(paramValue);
          }
        }
      }
    }
  
    return obj;
  }
  