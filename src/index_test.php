<?php
    // Functie: programma login OOP 
    // Auteur: Studentnaam

    // Initialisatie
    require_once 'config.php';
    require_once 'classes/User.php';
    $pdo = getPDO();

    //Main
    $piet = new User($pdo);
    $piet->username = "Piet";

    $piet->showUser();

    $jan = new User($pdo);
    $jan->username = "Jan";
    $jan->showUser();

?>
