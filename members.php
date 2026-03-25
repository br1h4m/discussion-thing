<?php
session_start();
if (!isset($_SESSION["User"])) {
    header("location: login.php");
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
<title>Membres</title>

   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="accueil.css">  
   <style>
.members {
    display: flex;
    flex-direction: column;
    gap: 8px;
    max-width: 600px;
    margin: 0 auto;
    background-color: #f0f2f5;
    padding: 20px;
    border-radius: 12px;
}

/* Chaque membre - style carte */
.userinfo {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
}

.userinfo:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Style pour la partie principale du user */
.userinfo {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 20px;
    flex-wrap: wrap;
    cursor: pointer;
}

/* Avatar généré automatiquement */
.userinfo::before {
    content: "👤";
    font-size: 24px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: white;
    font-size: 20px;
}

/* Conteneur du nom et badge */
.userinfo > :first-child {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

/* Nom du membre */
.usersname {
    font-size: 16px;
    font-weight: 600;
    color: #1e1f22;
    margin: 0;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* Badge admin */
.username.admin-badge {
    background: linear-gradient(135deg, #ff4757 0%, #ff6b81 100%);
    color: white !important;
    font-size: 11px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 20px;
    margin: 0;
    display: inline-block;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 4px rgba(255, 71, 87, 0.3);
}

/* Section More info - transformée en section déroulante */
.usersnameinfo {
    margin-left: auto;
    position: relative;
    width: 100%;
}

.moreinfousername {
    color: #6c757d;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    padding: 6px 12px;
    border-radius: 8px;
    transition: all 0.2s;
    list-style: none;
    background-color: #f8f9fa;
    display: inline-block;
}

.moreinfousername::-webkit-details-marker {
    display: none;
}

.moreinfousername::before {
    content: "▼";
    margin-right: 6px;
    font-size: 10px;
    display: inline-block;
    transition: transform 0.3s ease;
}

/* Animation du chevron quand ouvert */
.usersnameinfo[open] .moreinfousername::before {
    transform: rotate(180deg);
}

/* Contenu des détails - animation de développement */
.usersnameinfo {
    transition: all 0.3s ease;
}

.usersnameinfo[open] {
    animation: expandDetails 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.usersnameinfo ul {
    margin: 0;
    padding: 16px 20px;
    list-style: none;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-top: 1px solid #e9ecef;
    animation: slideDown 0.3s ease-out;
}

.usersnameinfo li {
    padding: 10px 0;
    font-size: 14px;
    color: #495057;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    align-items: center;
    gap: 12px;
}

.usersnameinfo li:last-child {
    border-bottom: none;
}

/* Icônes pour les infos */
.usersnameinfo li:first-child::before {
    content: "📧";
    font-size: 16px;
}

.usersnameinfo li:last-child::before {
    content: "👑";
    font-size: 16px;
}

/* Effet au survol des items */
.usersnameinfo li:hover {
    background-color: #f0f2f5;
    padding-left: 8px;
    transition: all 0.2s ease;
}

/* Animation keyframes */
@keyframes expandDetails {
    0% {
        opacity: 0;
        transform: translateY(-10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Style pour le survol du bouton More info */
.moreinfousername:hover {
    background-color: #e9ecef;
    transform: translateX(2px);
}

/* Animation d'apparition de la carte */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.userinfo {
    animation: slideIn 0.3s ease-out;
}

/* Responsive design */
@media (max-width: 768px) {
    .members {
        padding: 10px;
    }
    
    .userinfo {
        padding: 12px 16px;
        flex-wrap: wrap;
    }
    
    .userinfo::before {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
    
    .usersname {
        font-size: 14px;
    }
    
    .usersnameinfo ul {
        padding: 12px;
    }
    
    .usersnameinfo li {
        font-size: 12px;
        padding: 8px 0;
    }
}

/* Style pour le badge admin en mode mobile */
@media (max-width: 480px) {
    .username.admin-badge {
        font-size: 10px;
        padding: 3px 8px;
    }
    
    .moreinfousername {
        font-size: 12px;
        padding: 4px 10px;
    }
}

/* Scrollbar personnalisée pour le container */
.members::-webkit-scrollbar {
    width: 8px;
}

.members::-webkit-scrollbar-track {
    background: #e9ecef;
    border-radius: 10px;
}

.members::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 10px;
}

.members::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}

/* Optionnel : Ajouter une bordure décorative au dernier élément */
.userinfo:last-child {
    border-bottom: none;
}

/* Animation de pulsation pour le badge admin */
@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

.username.admin-badge {
    animation: pulse 2s infinite;
}
   </style>
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
            <a href="login.php" class="loginbouton">Login</a>
        <?php endif; ?>  
    </div>
</nav>
<div class="members">
    <?php 
    $file = file("Users.txt");
    foreach ($file as $users) {
        $user = explode(" ", trim($users));
        echo  '<div class="userinfo">
        <h1 class="usersname"> '.$user[0].'</h1>';
        if ($user[3] == "admin") {
            echo '<h2 class="username admin-badge" style="color:red"> Admin</h2>';
        }
        if ($_SESSION["User"]["role"] == "admin") {
        echo '<details class="usersnameinfo">
            <summary class="moreinfousername">More info</summary>
            <ul>';
            echo '<li>Email: ' .$user[1].'</li>';
            if ($user[3] == "admin") {echo '<li>Role: <span style="color:red">'.$user[3].'</span></li>';
            }
            else if ($user[3] == "membre") {echo '<li>Role: <span style="color:green">'.$user[3].'</span></li>';
            }
             echo' </ul></details>'; }
        echo '</div>';
        
    }
    ?></div>
    </body>
    </html>
