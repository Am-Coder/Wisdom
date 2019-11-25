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
		url : "DisplayBlog.php?blogid="+id,
		
		dataType : "json",//result expected from server
						//with json return type we can return java objects
						//With text we can return String from java conroller
		timeout : 10000,
		success : function(blogList) {
            
      console.log("Content");
			console.log(blogList);

			console.log(blog_container.childElementCount)
			var len = blog_container.childElementCount;
			for(i=0; i<len; i++){
				blog_container.removeChild(blog_container.children[0]);
			}			

			if(blogList.length != 0 && blogList ){

				for(i=0; i<blogList.length; i++){

            var blog = blogList[i];
            console.log(blog);

            blog_container.innerHTML = blog.BLOGTEXT

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
			container.innerHTML = "<h1 style='color:red'> Could not fetch Content, Some error occured </h1>";
			blog_container.append(container);
		},
		complete : function(e) {
			$(".loader").hide();
		}
	});
 

  getBlogComments(id);


  $('#submitComment').on('submit',function(e){
    e.preventDefault();
    var content = $.trim($('#comment').val());
    if(content == "")
      alert('Nothing to comment');
    else
      addComment(content,id)
  })
})


function getBlogComments(id){
  var com_container = document.getElementById('commentsList');

  $('.loaderComments').show();
  $.ajax({
      type : "GET",
      cache: false,
      // contentType : "application/json",//type of data being send to server
      url : "DisplayBlog.php?blogid="+id+"&com=1",
      
      dataType : "json",//result expected from server
              //with json return type we can return java objects
              //With text we can return String from java conroller
      timeout : 10000,
      success : function(comList) {
              
        console.log("Comment List");
        console.log(comList);

        console.log(com_container.childElementCount)
        var len = com_container.childElementCount;
        for(i=0; i<len; i++){
          com_container.removeChild(com_container.children[0]);
        }			

        if(comList.length != 0 && comList ){

          for(i=0; i<comList.length; i++){

              var comment = comList[i];
              console.log(comment);

              var container = document.createElement("li");
              // container.setAttribute("class","one_third first");
              // container.style.cssFloat="inline-end";
              container.style.margin="10px";
             
              var comTemplate= '<article>'+
                '<header>'+
                  '<figure class="avatar"><img src="../../img/images/demo/avatar.png" alt=""></figure>'+
                  '<address>'+
                  'By <a href="#">'+comment.email+'</a>'+
                  '</address>'+
                  '<time>' + comment.date_time +'</time>'+
                '</header>'+
                '<div class="comcont">'+
                  '<p>' + comment.content +'</p>'+
                '</div>'+
              '</article>';
          
                        
                container.innerHTML= comTemplate;
                com_container.append(container);
                // com_container.insertBefore(container,com_container.childNodes[0]);

          }
      
        }

      },
      error : function(e) {
        console.log("ERROR: ", e);
        var container = document.createElement("div");
        $(".loaderComments").hide();
        container.innerHTML = "<li style='color:red'> Unable to fetch comments, Some error occured </li>";
        com_container.append(container);
      },
      complete : function(e) {
        $(".loaderComments").hide();
      }
  });  
}

function addComment(content,id){
      $.ajax({
        type : "POST",
        cache: false,
        // contentType : "application/json",//type of data being send to server
        url : "DisplayBlog.php",
        data : {content: content, blogid: id},
        
        // dataType : "json",//result expected from server
                        //with json return type we can return java objects
                        //With text we can return String from java conroller
        timeout : 10000,
        success : function() {
            console.log("Upload done");
        },
        error : function(e) {
            alert('Some Problem Occured while uploading. Please try again after some time.')
            console.log("ERROR: ", e);
        },
        complete : function(e) {
          getBlogComments(id);
        }
    });

}
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
  