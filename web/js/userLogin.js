 function userLogin(){
      $.ajax({
          url: "../src/api/loginHandler.php", 
          type: "POST",
          data: {
              username: $( "#username" ).html(),
              password: $( "#password" ).html()
            },
          dataType: "html",
          async: false,
          success: function(result){
                /*$("#username").css('border', '1px solid green');
                $("#password").css('border', '1px solid green');*/
                console.log(result);
                if(result = null){
                  $("#username").css('border', '1px solid red');
                  $("#password").css('border', '1px solid red');
                  $("#error").html("The provided credentials were incorrect.<br>Please try again");
                } else{
                  console.log("REDIRECT AFTER SESSION STARTS");
                }
          },
          error: function(status,exception){
            console.log(status);
            console.log(exception);
            }
      });
}

