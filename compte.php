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
?>
<!DOCTYPE html>
<html>
    <head> 
<title>Compte</title>
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
<div class="infocompte">
    <?php
    echo '<h1 class="compte_">Username: '.$_SESSION["User"]["username"].'</h1><br>';
    echo '<h1 class="compte_">Email: '.$_SESSION["User"]["email"].'</h1><br>';
    echo '<h1 class="compte_">Role: '.$_SESSION["User"]["role"].'</h1><br>';
    ?>
</div>
    <body>
        
    </body>
</html>