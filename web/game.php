
<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/game.php");

$game = game_retrieve($_GET['id'],$link);

if(active_session() == 0){
  header("location:index.php?error=3");
  
}

if(isset($_GET["error"]) && $_GET["error"] == 3){
    echo "<script type='text/javascript'>alert('This doesn/'t do shit... yet);</script>";
}

if(isset($_GET["error"]) && $_GET["error"] == 1){
    echo "<script type='text/javascript'>alert('You are already subscribed to this event');</script>";
}




?>



<html>
<head>
 <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-fluid">

<div class="row">

    <? include("menubar.php"); ?>

    <div class="col">
      <? include("topbar.php"); ?>

      <div class="row">
        <div class="col content" style="background-color: rgba(255, 255, 255, 0.6)">
            <h5>Event information:</h5>
            <hr class="content">

                <div class="row" style="margin:-4px;width:30%;">
                  <ul class="list-group" style="">
                    <li>When: <?= $game["date"]; ?></li>
                    <li>Type: <?= $game["type"]; ?></li>
                  </ul>
                </div> 
                <? game_organize_teams($_GET['id'],$link,$_SESSION['id']) ?>
        </div> 
        <div class="col-3 content" style=";background-color: rgba(255, 255, 255, 0.6)">   
                <div class="col content" style="margin:0px">
             	  	<h5>Add an outsider:</h5>
             	  	<form method="POST" action="src/add.php">
             	  		<label>Name:</label>
             	  		<input class="content" type="text" name="nickname" placeholder="Your friend's name"></input>
             	  		<label>Sex:</label>
             	  		<select class="content" name="gender">
                                <option>Male</option>
                                <option>Female</option>
                    </select><br>
                    <button class="content team" type="submit">Submit</button>
                    <input name="gameId" hidden value="<?=$_GET['id']?>"></input>
             	  	</form>
             	</div>
              <div class="col content" style="margin:0px">
              <h5>Current players:</h5>
                  
                  <label>Male: <?= game_retrieve_attribute_ammount($_GET['id'],$link,"player.genderId","2")?></label><br>
                  <label>Female: <?= game_retrieve_attribute_ammount($_GET['id'],$link,"player.genderId","1")?></label>
              </div>
              <div class="col content" style="margin:0px">
              <h5>Doodle URL:</h5>
              <form action="src/crawler.php" method="POST">
                <input name="doodleUrl" class="team content">
                <input hidden name="game_id" value="<?= $_GET['id'] ?>">
                <button class="team content">Load</button>
              </form>
              </div>
              
      </div> <!-- End of both col -->
    </div>

    <?if(query_retrieve_team($_GET['id'],'5',$link) != "Error"){?>
    <div class="row">
       <div class="col content" style="background-color:rgba(255, 255, 255, 0.6)">
                <h6>Teamless</h6>
                <hr class="content"> 
                <? organize_team($_GET['id'],'5',$link,'0',$_SESSION['id']); ?>
                </div>
    </div>
    <? } ?>

              

            
    
		</div> <!-- Col Div -->
</div>

</div><!-- Row Div -->

</body>
</html>
