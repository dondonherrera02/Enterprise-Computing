<?php 
$conn = mysqli_connect("localhost", "root", "", "login");

if($conn){
    // break the html structure, check inspect
    // echo "We are connected";

    echo "<script>console.log('We are connected')</script>";
}else{
    // echo "We are not connected" . mysqli__error($conn);

    die("Connection failed" . mysqli_connect_error());
};