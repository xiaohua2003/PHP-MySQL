<?php
//using MySQLi to connect the database 
$conn=mysqli_connect('localhost','Emily','123','piza store');
//check connection
if(!$conn){
    echo 'connection error:'.mysqli_connect_error();
}else{
    echo 'connection is successful';
}
?>