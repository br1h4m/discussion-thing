<?php
session_start();
if (!isset($_SESSION["User"])) {
    header("location: login.html");
    exit;
}
else {
        $path = "notifications/$username.txt";
        $messages = file($path);
if ($messages) {
foreach ($messages as $messag) {  
    echo htmlspecialchars(trim($messag))."<br>";
}
}
}
?>