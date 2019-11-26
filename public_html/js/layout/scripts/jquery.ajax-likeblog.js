$(document).ready(function(){

    var url = window.location.href;
    id = getAllUrlParams(url).blogid;
    console.log(url);
    console.log(getAllUrlParams(url));
    console.log(getAllUrlParams(url).blogid);

    $('#likeBtn').on('click',function(e){
        e.preventDefault();
        var col = $.trim($(this).css('color'));
        // alert(col);

        if(col == "rgb(128, 128, 128)"){
            $(this).css("color","gold");
            like(id);
        }else if( col == "rgb(255, 215, 0)" ){
            $(this).css("color","gray")
            unlike(id);
        }
    })
   


})



function like(id){
    // alert("like");
      $.ajax({
        type : "POST",
        cache: false,
        // contentType : "application/json",//type of data being send to server
        url : "DisplayBlog.php",
        data : {like: "1", blogid: id},
        
        dataType : "json",//result expected from server
                        //with json return type we can return java objects
                        //With text we can return String from java conroller
        timeout : 10000,
        success : function(obj) {
            console.log(obj);
            $("#likeCount").html(obj.claps)
        },
        error : function(e) {
            alert('Some Problem Occured while uploading. Please try again after some time.')
            console.log("ERROR: ", e);
        },
        complete : function() {
          
        }
    });

}

function unlike(id){
    // alert("Unlike");
    $.ajax({
      type : "POST",
      cache: false,
      // contentType : "application/json",//type of data being send to server
      url : "DisplayBlog.php",
      data : {like: "-1", blogid: id},
      
      dataType : "json",//result expected from server
                      //with json return type we can return java objects
                      //With text we can return String from java conroller
      timeout : 10000,
      success : function(obj) {
            console.log(obj);

            $("#likeCount").html(obj.claps)
      },
      error : function(e) {
          alert('Some Problem Occured while uploading. Please try again after some time.')
          console.log("ERROR: ", e);
      },
      complete : function() {
        
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
  