<!DOCTYPE html>
<html>
<head>
<body bgcolor="lightblue">
        <h1 style="text-align:center">Cal State Fullerton Basketball Statistics</h1>
		
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body bgcolor="lightblue">
<title>GameRounds</title>
<?php
      require_once('navbar.php');
	  require_once('createDB.php');
	  

/////////////////////////////// ---QUERY 3---- ///////////////////////////////////////////////		  

$query3 = "SELECT t1.GameRound, t1.TeamID_A, t1.TeamAPoints, t1.DateTracker, t2.TeamName
				FROM GP_Team AS t1 INNER JOIN LeagueTeam AS t2
				 ON t1.TeamID_A = t2.TeamID
				 ORDER BY GameRound"; 
				
		  if(!$result3 = mysqli_query($link,$query3)) 
		  {
			  die('There was an error running query:3 ');
		  }

							  

/////////////////////////////// ---QUERY 4---- ///////////////////////////////////////////////

  $query4 = "SELECT t1.GameRound, t1.TeamID_B, t1.TeamBPoints, t1.DateTracker, t2.TeamName
				FROM GP_Team AS t1 INNER JOIN LeagueTeam AS t2
				 ON t1.TeamID_B = t2.TeamID
				 ORDER BY GameRound"; 
				 
		  if(!$result4 = mysqli_query($link,$query4))
		  {
			  die('There was an error running query:4 ');
		  }
	
/////////////////////////////////////////////////////////////////////////////////////////////		  
	  
	  
	  ////////////////////// USE CASE 4 /////////////////////////////
?>
<table style="border:1px solid black; border-collapse:collapse;">
<h2>Game Rounds</h2>
      <tr>
       
  
        <th colspan="1" style="vertical-align:top; width:50px; border:1px solid black; background: lightblue;"> Game Round </th>
		<th colspan="1" style="vertical-align:top; width:150px; border:1px solid black; background: lightblue;">Team Name</th>
		<th colspan="1" style="vertical-align:top; width:150px; border:1px solid black; background: lightblue;">  Points  </th>
        
      </tr>
   <?php
        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';
	  
		
		   if((mysqli_num_rows($result3) > 0) && (mysqli_num_rows($result4) > 0) ){                 // PR
          
				while (($row = mysqli_fetch_array($result3)) && ($row2 = mysqli_fetch_array($result4)) )  // PR
			    {
				echo "      <tr>\n";
			
				echo "<td  $fmt_style>". $row['GameRound'] . "</td>\n";
				echo "<td  $fmt_style>". $row['TeamName'] ."<br/>-vs-<br/>".$row2['TeamName']. "</td>\n";
				echo "<td  $fmt_style>". $row['TeamAPoints'] ."<br/>---<br/>".$row2['TeamBPoints']. "</td>\n";
				
				echo "      </tr>\n";
				}
				ob_start();
			}


		  ?>
</table>



</body>
</head>
</html>