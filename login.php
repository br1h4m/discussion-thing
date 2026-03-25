    <?php
    session_start();
    if (isset($_POST["logout"])) {
        session_destroy();
        header("location: login.html");
        exit;
    }
    if (!isset($_POST["email"])) {
        header("location: login.html");
        exit;
    }
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $lignes = file("Users.txt");
    foreach ($lignes as $ligne) {
        $mots = explode(" ", trim($ligne));
        if (($email == $mots[0]) || ($email == $mots[1])) {
            if (password_verify($password, $mots[2])) {
                $_SESSION["User"] = ["username" => $mots[0], "email" => $mots[1], "role" => $mots[3]];
                header("location: accueil.php");
                exit;
            } 
            else {
            
            header("Location: login.html?error=incorrect_password");
            exit;
            }
        }
    }
    header("Location: login.html?error=username_not_found");
    ?>
