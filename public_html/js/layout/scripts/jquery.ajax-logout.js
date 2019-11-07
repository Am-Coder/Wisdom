$(document).ready(function(){
    $("#logOut").click(function(event){
        event.preventDefault();
        $.ajax({
            type : "GET",
            cache: false,
            // contentType : "application/json",//type of data being send to server
            url : "Logout.php",
            // data : JSON.stringify({email: $("#email").val()}),
            
            // dataType : "json",//result expected from server
                            //with json return type we can return java objects
                            //With text we can return String from java conroller
            timeout : 100000,
            success : function() {
    
                    window.location.replace("http://localhost:7777/sofia/public_html/Index.html");
     
            },
            error : function(e) {
                console.log("ERROR: ", e);
            },
            complete : function(e) {
                
            }
        });
    })

})