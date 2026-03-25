<?php
session_start();
$file = fopen("Users.txt", "r");


$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirmpassword = $_POST["confirmpassword"];

if (strlen($username) < 3 || strlen($username) > 32) {
    echo "Username length should be between 3 and 32";
    return;
}
if ($password != $confirmpassword) {
header("location: register.html?error=unmatched_passwords");
exit;
} 
$trouve = false;
    while(($ligne = fgets($file)) !== false) {
        $information = explode(" ",trim($ligne));
      if ($username == $information[0] || $email == $information[1]) {
        $trouve = true;
        break;
      }
    }
    if ($trouve) {
        header("location: register.html?error=username_already_exists");
        exit;
    }
fclose($file);

$file = fopen("Users.txt", "a");
$ligne_user_info = "$username $email $password membre\n";
$_SESSION["User"] = ["username" => $username, "email" => $email, "role" => "membre"];
fwrite($file, $ligne_user_info);
fclose($file);

header("Location: accueil.php");
exit;
?>