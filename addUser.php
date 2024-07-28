<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/style.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>
    <h2>Profile added to our database!!</h2>
    <a href="./index.html" class="goback">Go back to the main page</a>
</body>
</html>
<?php 
    $host = "ID386613_Tinder.db.webhosting.be";
    $user = "ID386613_Tinder";
    $pass = "Tinder123";
    $db = "ID386613_Tinder";
    $port = 3306;

    $conn = mysqli_connect($host, $user, $pass, $db, $port);

    IF ($conn == false){
        echo "bad connection";
        die();
    };
    

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $pgender = $_POST['Pgender'];
    $pwd = $_POST['password'];
    $DoB = $_POST['DoB'];

    $query = "INSERT INTO user (FName, LName, GenderID, Password, DoB) VALUES ('$fname', '$lname', '$gender', '$pwd', '$DoB');";
    $result = mysqli_query($conn, $query);


    $sql = "SELECT ID FROM user WHERE FName LIKE '$fname' AND Password LIKE '$pwd'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           $id = $row['ID'];
        }
    } 
    
    $query = "INSERT INTO preffered_gender (UserID, GenderID) VALUES ('$id', '$pgender')";
    $result = mysqli_query($conn, $query);

?>