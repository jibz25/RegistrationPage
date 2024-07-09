<?php
     $con = mysqli_connect("localhost","root","", "databasegym");
     if($con == false){
        die("Connection Error". mysqli_connect_error());
     }
?>