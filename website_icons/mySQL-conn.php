<?php
//Create connection
    $conn = new mysqli("localhost", "root", "", "profileuploader");

    if($conn->connect_error){  //Ckecking database connection
        die("Connection failed: ". $conn->connect_error);
    }
?>