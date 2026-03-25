<?php
$file = "Users.txt";
$users = file($file);
$count = 0;
foreach ($users as $user) {
    $mots = explode(" ", trim($user));
    $name = "$mots[0]$count";
    $path = "notifications/$name.txt";
    $notifile = fopen($path, "w");
}
?>