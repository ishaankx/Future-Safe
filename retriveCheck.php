<?php
include "mysql_conn.php";
// database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "futuresafe";

// create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// retrieve the email input from the form
$email = $_POST['email'];

// query the database to check if the email exists in the users table
$sql = "SELECT * FROM userr WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

// check if any row was returned
if (mysqli_num_rows($result) > 0) {
    // email exists in the users table
    $row = mysqli_fetch_assoc($result);
    $delivery_time = strtotime($row["delivry_time"]);
    $current_time = time();
    if ($current_time == $delivery_time) {
        echo "Delivery time has been reached.";
        {
            // Convert BLOB to JPEG and display photos attribute
        $photosData = base64_decode($photos);
        $imageName = 'photos.jpg'; // Specify the desired image name
        file_put_contents($imageName, $photosData);
        echo "Photos: <br>";
        echo "<img src='" . $imageName . "' alt='Photos'>";
        echo $text;
        }
        // do something here, such as sending an email or notification
    } else {
        echo "Delivery time has not been reached yet.";
    }
} else {
    // email does not exist in the users table
    echo "Email does not exist in the users table";
}

// close the database connection
mysqli_close($conn);
?>
