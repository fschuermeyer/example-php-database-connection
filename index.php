<?php

    require_once('ConnectionPDO.php');

    /* PDO Objekt erstellen über eine Gesonderte Funktion */

    $pdo = pdoObject([
            'host' => '127.0.0.1:3306', // Host IP der Datenbank 
            'name' => 'Testing', // Name der Datenbank
            'user' => 'testUser', // Zugangsdaten für Nutzer
            'pass' => 'rootroot']);


    /*    var_dump ist eine Native PHP Funktion um Variablen auszuwerten
    *     SelectUser() Function dort drinnen befindet sich ein Prepared Statement für Select Statements 
    *     Es werden alle User mit der PersonalID 0 Aussgegeben als Assozativer Array
    */

    echo '<pre>';

    var_dump(SelectUser($pdo,'0'));

    echo '</pre>';
