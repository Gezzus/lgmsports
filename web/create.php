<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/menumanager.php");
include("src/game.php");
?>


<?php

?>

<html>
<head>
 <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-fluid">

<div class="row">




	<div class="col-2 menu">
		<hr class="menu">
			<div class="row">
				<a class="menubutton" href="index.php">
					<button class="menubutton">Events</button>
				</a>
			</div>
			<?php if(active_session() == 0){ ?>
			<div class="row">
				<a class="menubutton" href="login.php">
					<button class="menubutton">Login</button>
				</a>
			</div>
			<div class="row">
				<a class="menubutton" href="register.php">
					<button class="menubutton">Register</button>
				</a>
			</div>
			<?php } else{ ?>
				<div class="row">
				<a class="menubutton" href="logout.php">
					<button class="menubutton">Logout</button>
				</a>
				</div>
			<?php } ?>

	
		
	</div> <!-- Menu div -->
		<div class="col">
			<div class="row"">
			<div class="col top">
			<a href="index.php" class="top" >Back</a>
			</div>
			</div>
		 	<div class="row">
                  <div class="col-8 content">
                  	<h5>Create event: </h5>
                  	<hr class="content">
                      <div class="row" style="padding-left:3.5%">
                        	
                      </div>


             	  </div>	
            
                  <div class="col-3">
                
                    	
             	  </div>
             	  	  
            </div>
            

            <div class="row">
            	<div class="col myfooter">
            		<footer class="myfooter">
						<p class="myfooter">Made with ♥ by a bunch of people from Avature</p>
					</footer> 
            	</div>
            </div>

    		
    	
		</div> <!-- Col Div -->
			
</div><!-- Row Div -->

</div>

	

</body>

</html>

