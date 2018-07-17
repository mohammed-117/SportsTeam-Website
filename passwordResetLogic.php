<?php
    require_once("createDB.php");
     $userName = trim($_POST['userName']);
     $userName = strip_tags($_POST['userName']);
     $userName = htmlspecialchars($_POST['userName']);

     $password = trim($_POST['password']);
     $password = strip_tags($_POST['password']);
     $password = htmlspecialchars($_POST['password']);

     if (preg_match('/^[a-zA-Z0-9_]*$/', $password)) {
     $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
     $sql = "UPDATE UserLogin SET Password='$passwordHashed' WHERE UserName='$userName'";
    if ($link->query($sql) === TRUE) {
    echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
        require("login.php");
    }
} else {
    echo "Password does not follow the standard";
            require('login.php');
}
    require('login.php');

     ?>