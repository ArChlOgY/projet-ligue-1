<?php

$email = $_POST['email'];
$pass = $_POST['password'];

if (!empty($email) && !empty($pass)) {
    if ($email == "azerty@foreach.com" &&  $pass == "1234") {
        header("Location:../index.php?return=success");
    } else {
        header("Location:../index.php?return=error");
    }
}else{
        header("Location:../index.php?return=error");
    }
?>