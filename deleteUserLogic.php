<?php
    require_once('createDB.php');
    $email = $_POST['email'];

    $sql = "Delete From UserLogin WHERE Email = '$email'";

    if ($link->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header('location: users.php');
    } else {
        echo "Error deleting record: " . $link->error;
    }


?>