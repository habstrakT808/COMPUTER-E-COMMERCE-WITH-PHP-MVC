<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
</body>
</html>

<?php 
include_once "class_autoloader.php";

if (isset($_POST["update"])) 
{
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repeatPwd = $_POST["repeat_pwd"];
  $email = $_POST["email"];
  $memberID = $_POST["id"];

  $setAcc = new ProfileContr($username, $pwd, $repeatPwd, $email, $memberID);
  $setAcc->updateUserAccount();
}
else
{
  header("location: ../manage_profile.php");
  exit();
}