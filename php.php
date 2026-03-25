<html>
    <head>
        <title>Php lesson</title>
    </head>
    <body>
        <?php
        $color = "red";
        echo "My color is $color <br>";
        $x = 4;
        $y = 6;
        echo ($x + $y)."<br>";
        $texte = "les méchants";
        echo "J'aime pas ".$texte;
        echo "<br>";
        var_dump($x);
        echo "<br>";
        var_dump($texte);
        echo "<br>";
        var_dump(NULL);
        echo "<br>";
        $x = $y = $z = "Fruit de mer";
        echo $x." ".$y." ".$z."<br>";
        echo "this","ugly","boy","<br>";
        $a = strlen($texte);
        echo "La longueure du texte les méchants est $a <br>";
        $b = str_word_count($texte, 0, "é");
        echo "Le nombre de mot qu'elle contient: $b <br>";
        echo "Maintenant on vérifie si elle contient la lettre z avec var_dump 
        et non une condition if: <br>";

        var_dump(str_contains($texte, "z"));
        echo "<br>Maintenant on vérifie si y a la lettre o: <br>";
        var_dump(str_contains($texte, "o"));
        echo "<br>Maintenant on essaye avec un mot: les<br>";
        var_dump(str_contains($texte, "les"));
        echo "<br>Maintenant on vérifie la pos du mot les: <br>";
        echo strpos($texte, "les"),"<br>";
        echo "Maintenant avec un mot qui n'existe pas: <br>";
        echo strpos($texte, "oiseau"),"<br>";
        $texte2 = "Les gens sont pas très sympatoches ces derniers temps";
        echo 'Texte2: ',$texte2,'<br>';
        echo "On vérifie si le texte commence par \"gens sont\"<br>";
        var_dump(str_starts_with($texte2, "gens sont"));
        echo "<br>Maintenant si elle se termine par \"derniers temps\"<br>";
        var_dump(str_ends_with($texte2, "derniers temps"));
        echo "<br>";
        $texte3 = "tout en majuscule";
        echo $texte3," (sans strtoupper)<br>";
        echo strtoupper($texte3),"<br>";   
        $texte3 = strtoupper($texte3);
        echo $texte3, "<br>";
        echo strtolower($texte3),"<br>";
        echo "Remplacer le mot majuscule par minuscule maintenant: <br>";
        echo str_replace("majuscule", "minuscule",strtolower($texte3));
        echo "<br>", strrev($texte3);
        $texte4 = "      lol";
        echo "<br>", trim($texte4);
        echo "<br>$texte ", strtolower("$texte2 $texte3 $texte4");
        echo "<br>";
        $cars = array("Mercedes", "Toyota", "Peugeot");
        var_dump($cars);
        echo "<br>";
        $membres = array("1" => "Papa", "2" => "Maman", "3" => "Hamza");
        foreach ($membres as $key => $value) {
            echo "$key $value"."<br>";
        }
        echo $membres["2"]."<br>";
        echo $membres[1];
        function AppelFonction() {
            echo "Wallah gg bro <br>";
        }
        echo "<br>";
        $AppelF = array("Pas maison", 22, 67 ,"AppelFonction");
        $AppelF[3]();
        $AppelF = array("Pas maison", 22, 67 ,"44" => "AppelFonction");
        $AppelF["44"]();
        $Fruits = array("Pomme", "Banane", "Raisins");
        echo "<br>";
        foreach ($Fruits as $value) {
            echo $value."<br>";
        }
        echo "<br>";
        $Fruits["nouveau fruit"] = "Ananas";
        foreach ($Fruits as $key => $value) {
           
            if ($key == "nouveau fruit") {
                echo "$value: $key <br>";
            } else echo $value."<br>";
        }

        ?>
        
    </body>
</html>