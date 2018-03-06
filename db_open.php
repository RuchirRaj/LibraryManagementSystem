<?php
//Connect to MySQL and Select DB
$host="localhost";
$username="root";
$password="root";
$db_name="library";
$con=mysqli_connect("$host", "$username", "$password", "$db_name") or die("cannot connect");
// mysqli_select_db("$con","$db_name") or die("cannot select DB");
?>