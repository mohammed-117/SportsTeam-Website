<?php

// create short variable names
$name       = (int) $_POST['name_ID'];  // Database unique ID for player's name
//$points     = (int) $_POST['points'];
//$assists    = (int) $_POST['assists'];
//$rebounds   = (int) $_POST['rebounds'];

if( empty($name)     ) $name      = null;
// see below for $time processing
//if( empty($points)   ) $points    = null;
//if( empty($assists)  ) $assists   = null;
//if( empty($rebounds) ) $rebounds  = null;




if( ! empty($name) )  // Verify required fields are present
{
  require_once( 'createDB.php' );

    $query = "INSERT INTO Statistics SET
                Player          = ?,
			   PlayingTimeMin  = ?,
               PlayingTimeSec  = ?,
                Points          = ?,
                Assists         = ?,
                Rebounds        = ?";
				
				

    $stmt = $link->prepare($query);
	
    $stmt->bind_param('dddddd', $name,$minutes, $seconds, $points, $assists, $rebounds);
    $stmt->execute();

}

require('AddPlayer.php');

?>