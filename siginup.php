<?php
include "db.php";

// Check if form submitted
if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])){

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if already one user exists
    $check = mysqli_query($conn, "SELECT * FROM users");
    if(mysqli_num_rows($check) >= 1){
           $message="Access denied";
            echo"<script>alert('$message');
            window.location.href='sign.php';   
            </script>";
        exit();
    }

    // Hash password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";

    if(mysqli_query($conn, $sql)){
        echo "User registered successfully!";
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

}else{
    echo "All fields required!";
}
?>
