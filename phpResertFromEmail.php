<?php
      require("createDB.php");
     $userName = trim($_REQUEST['userName']);
     $userName = strip_tags($_REQUEST['userName']);
     $userName = htmlspecialchars($_REQUEST['userName']);

     $password = trim($_REQUEST['password']);
     $password = strip_tags($_REQUEST['password']);
     $password = htmlspecialchars($_REQUEST['password']);

     $sql = "SELECT ID FROM userLogin where UserName = '$userName' AND Password = '$password'";
     $result = mysqli_query($link, $sql);
     $row = mysqli_fetch_array($result);
     $found = isset($row['found']);
     $counter = mysqli_num_rows($result);

        if($counter == 1) {
            require('passwordUpdate.php');
        } else  {
                echo ("<p> Your Login Name does not match up</p>");
                require("login.php");
                }  

?>

