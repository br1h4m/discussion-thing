<?php
    $file = "commentaire.txt";
    if (file_exists($file)) {
        echo filemtime($file);
    }
?>