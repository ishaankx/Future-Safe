<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email-input'];
    $text = $_POST['text'];
    $photo = $_FILES["image-input"]["tmp_name"];
    $delivery_date = $_POST['date-input'];
    $delivery_time = $_POST['time'];
    $pdf_file = $_FILES["pdf-input"]["tmp_name"];
    $delivery_datstr = $delivery_date." ".$delivery_time.":00".":00";
    // $timestamp = strtotime();
    $timestamp = strtotime($delivery_datstr); // convert date string to Unix timestamp
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "futuresafe";
    $con= mysqli_connect($servername, $username,$password,$database);
    if(!$con){
        die("Not connected");
    }
    else{
        echo "connection was succusfull \n";
    }
    if ($_FILES["image-input"]["error"] == 0) {
        $photoData = addslashes(file_get_contents($photo));   
        $sql = "insert into  user values('$text','$photoData','$email','$delivery_date','$timestamp','$pdf_file')";
        $result = mysqli_query($con,$sql);
        if($result){
            echo "Entry added succusfully";
        }
        else{
            echo "error occured and that is :".mysqli_error($con);
        }
    }
    else {
        echo "error";
        echo "Error uploading photo: " . $_FILES["photo"]["error"];
    }
}else{
    echo "No data received";
}

?>
