<?php
session_start();
 if (isset($_SESSION["User"])) {
        header("location: accueil.php");
        exit;
    }
$file = fopen("Users.txt", "r");


$username = trim($_POST["username"]);
$email = trim($_POST["email"]);
$password = $_POST["password"];
$confirmpassword = $_POST["confirmpassword"];
$hash = password_hash($password, PASSWORD_DEFAULT);
if (strlen($username) < 3 || strlen($username) > 32) {
    echo "Username length should be between 3 and 32";
    return;
}
if ($password != $confirmpassword) {
header("location: register.php?error=unmatched_passwords");
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
        header("location: register.php?error=username_already_exists");
        exit;
    }
fclose($file);

$file = fopen("Users.txt", "a");
$ligne_user_info = "$username $email $hash membre\n";
$_SESSION["User"] = ["username" => $username, "email" => $email, "role" => "membre"];
fwrite($file, $ligne_user_info);
fclose($file);

header("Location: accueil.php");
exit;
?>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="style.css">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="login">
            <form action="register.php" method="POST">
                <label class="labelsite">Username: </label>
                <input type="text" name="username" class="buttonl" required>

                <label class="labelsite">Email: </label>
                <input type="email" name="email" class="buttonl" required>

                <label class="labelsite">Password: </label>
                <input type="password" name="password" class="buttonl" required>

                <label class="labelsite">Confirm password: </label>
                <input type="password" name="confirmpassword" class="buttonl" required>

                <input type="submit" value="Register" class="buttonl">
            </form>
        </div>
        <div class="bodylogin">
            <a href="login.php" class="textl">Or login</a>
        </div>
    </body>
</html>