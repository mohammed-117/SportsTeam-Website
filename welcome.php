<!DOCTYPE html>
<?php
          require_once('createDB.php');
          echo "You are loggin as '" . $_SESSION['UserName'] . "' as '" . $_SESSION['UserRole'] . "'<br/>";
          echo "-- display login form --<br/>";        
?>
<html>
<head>

<body>
        <h1 style="text-align:center">Cal State Fullerton Basketball Statistics</h1>

       



<table width='350'  border="0" align="center" cellpadding="3" cellspacing="1" class="table table-bordered table-dark">

        <h1>Welcome to the Site</h1>
      <tr>
        <th style="vertical-align:top; border:1px solid black; background: darkblue;">Registered Users IDs</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Team Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Username</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Role</th>

      </tr>
      <?php

        include_once('navbar.php');
        

        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';
        

        $sql = "SELECT id, Name_First, Name_Last, UserName, Role FROM userlogin";
        $result = $link->query($sql) or die($link->error);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) 
        {

          echo "      <td </td>\n";
          echo "$row[id]";
          echo "      <td </td>\n";
          echo "$row[Name_First]";
          echo " $row[Name_Last]";
          echo "      <td </td>\n";
          echo " $row[UserName]";
          echo "      <td </td>\n";
          echo " $row[Role]";
          echo "      <tr>\n";
          


        }

      }
        
        
      ?>

      <tr>

        <th style="vertical-align:top; border:1px solid black; background: darkblue;">Teams In The League IDs</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Team Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Coach</th>
        


      </tr>


<?php
$sql = "SELECT TeamID, TeamName FROM LeagueTeam";
$result = $link->query($sql) or die($link->error);

$sqltwo = "SELECT ID, Name_First, Name_Last FROM LeagueTeamCoach";
$resulttwo = $link->query($sqltwo) or die($link->error);

if (($result->num_rows > 0) &&  ($resulttwo->num_rows > 0)) {
// output data of each row
while(($row = $result->fetch_assoc()) && ($rowtwo = $resulttwo->fetch_assoc()) ) 
{

  echo "      <td </td>\n";
  echo "$row[TeamID]";
  echo "      <td </td>\n";
  echo "$row[TeamName]";
  echo "      <td </td>\n";
  echo " $rowtwo[Name_First]"." "."$rowtwo[Name_Last]";
  echo "      <td </td>\n";
  echo "      <tr>\n";

}
}
?>

<tr>
 <th style="vertical-align:top; border:1px solid black; background: darkblue;">User Logins in the last 48 hours</th> 
 <th style="vertical-align:top; border:1px solid black; background: lightblue;">Username</th>
 <th style="vertical-align:top; border:1px solid black; background: lightblue;">Role</th>
 <th style="vertical-align:top; border:1px solid black; background: lightblue;">Last Logged In</th>
 


 </tr>



<?php
$sql = "SELECT UserName, Role, ts FROM userlogin";
$result = $link->query($sql) or die($link->error);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) 
{

  echo "      <td </td>\n";
  echo "      <td </td>\n";
  echo "$row[UserName]";
  echo "      <td </td>\n";
  echo "$row[Role]";
  echo "      <td </td>\n";
  echo " $row[ts]";
  echo "      <tr>\n";


}
}


?>
  




</body>
</head>
</html>
