<?php

// create short variable names
$firstName     = trim( preg_replace("/\t|\R/",' ',$_POST['firstName']) );
$lastName      = trim( preg_replace("/\t|\R/",' ',$_POST['lastName'])  );


if( empty($firstName) ) $firstName = null;
if( empty($lastName)  ) $lastName  = null;



if( ! empty($lastName) ) // Verify required fields are present
{
  require_once( 'createDB.php' );
  


    $query = "INSERT INTO TeamRoster SET
                Name_First = ?,
                Name_Last  = ?";
				
    $stmt = $link->prepare($query);
    $stmt->bind_param('ss', $firstName, $lastName);
    $stmt->execute();
  }


require('AddPlayer.php');

?>
