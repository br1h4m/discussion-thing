<?php
session_start();
if (!isset($_SESSION["User"])) {
    header("location: login.html");
    exit;
}
if (isset($_POST["logout"])) {
session_destroy();
 unset($_SESSION["User"]);
 header("location: ".$_SERVER["PHP_SELF"]);
 exit;
} 
if (!empty($_POST["commentaire"]) && isset($_SESSION["User"])) {
    $commentaire = $_POST["commentaire"];
    $filepath = "commentaire.txt";
    $username = $_SESSION["User"]["username"];
    if (strlen($commentaire) > 0) {
    $messageafficher = "$username: $commentaire\n";
    file_put_contents($filepath, $messageafficher, FILE_APPEND);
    }
    header("location: ".$_SERVER["PHP_SELF"]);
    exit;
   
}
if (isset($_POST["delete_index"]) && isset($_POST["delete_comment"])) {
    $index = intval($_POST["delete_index"]);
    $lignes = file("commentaire.txt");
    unset($lignes[$index]);
    $lignes = array_values($lignes);
    file_put_contents("commentaire.txt", implode("\n", $lignes));
    header("location: ".$_SERVER["PHP_SELF"]);
    exit;
}
?>

<!DOCTYPE html>
<html>
    <!-- head-->
    <head>
<title>Accueil</title>
<link rel="stylesheet" href="accueil.css">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
   <!-- body-->
<body>
<nav class="navigationbar">
    <div class="navigationbardiv">
        <a href="accueil.php" class="">Accueil</a>
        <?php if (isset($_SESSION["User"]["username"])):?>
            <a href="members.php" class="comptehref">Membres</a>
             <a href="compte.php" class="comptehref">Compte</a>               
             <details>

                <summary><img src="images/bell.png" style="margin-left:30px; height:30px; width:30px"></summary>
             </details>
             <details>
             <summary><img src="images/menu.png" style="height:20px; width:20px;"></summary>
                  <ul class="navigations">
                      <li>
                        <form method="POST">
                        <input type="submit" name="logout" class="logoutbouton" value="Logout">
                        </form>
                      </li>
                  </ul>
             </details>   
        <?php elseif (!isset($_SESSION["User"]["username"])): ?>
            <a href="login.html" class="loginbouton">Login</a>
        <?php endif; ?>  
    </div>
</nav>
<div class="sectioncommentaire">
    <label class="labelcommentaire">Envoyer un message dans la discussion: </label>
    <form method="POST" action="">
        <input type="text" class="champtext" name="commentaire" required>
        <input type="submit">
    </form>
<?php 
$file = file("commentaire.txt");
 
if ($file) {
    foreach(array_reverse($file,true) as $index => $commentaire) {
        if ($commentaire != "\n")
 {
        echo '<h1 class="commentaire_envoye">'.htmlspecialchars(trim($commentaire)).'</h1>';
        if ($_SESSION["User"]["role"] == "admin" && isset($_SESSION["User"]["role"])) {
        echo ' <form method="POST" action="" style="display:inline">
        <input type="hidden" name="delete_index" value="'.$index.'">
        <input type="submit" name="delete_comment" value="delete">
    </form>';
    echo "<br>";
        }
        else echo "<br>";
        }
        
    }
}
?>  
</div>
<!--
<div class="">
    <form method="POST" action="">
        <input type="text" class="" name="message">
        <input type="submit" value="Send">
    </form>
</div>
        -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
let lastModified = null;

function checkUpdate() {
    fetch("check_update.php")
    .then(res => res.text())
    .then(time => {
        if (lastModified === null) {
            lastModified = time;
        } else if (lastModified != time) {
            location.reload(); // recharge seulement si modifié
        }
    });
}

setInterval(checkUpdate, 200);
</script>
</body>
<!-- end -->
</html>