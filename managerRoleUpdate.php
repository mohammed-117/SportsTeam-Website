<?php
      require_once('navbar.php');
      include_once('createDB.php');


       if ($_POST['role'] == 1) {
            $role = 1;
        }
        else if ($_REQUEST['role'] == 2) {
            $role = 2;
        } else {
            $role = 3;
        }

        $Name_First = $_REQUEST['firstName'];
        $Name_Last = $_REQUEST['lastName'];


        $sql = "UPDATE UserLogin SET Role ='$role' WHERE Name_First = '$Name_First' AND Name_Last = '$Name_Last'";
        $query = mysqli_query($link, $sql);
             if (!$query) {
	              die ('SQL Error: ' . mysqli_error($link));
              }

              include_once('users.php');
?>
