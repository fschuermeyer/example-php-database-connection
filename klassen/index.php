<?php

    require_once('ConnectionPDO.php');

    /* Connection PDO instanz erzeugen um dann auf die Methoden der Klasse "Connection PDO"
        erfolreich zugreifen zu können. */

    $pdo = new ConnectionPDO([
            'host' => '127.0.0.1:3306', // Host IP der Datenbank 
            'name' => 'Testing', // Name der Datenbank
            'user' => 'testUser', // Zugangsdaten für Nutzer
            'pass' => 'rootroot']);


    /*    var_dump ist eine Native PHP Funktion um Variablen auszuwerten
    *     SelectUser() Methode dort drinnen befindet sich ein Prepared Statement für Select Statements 
    *     Es werden alle User mit der PersonalID 0 Aussgegeben als Assozativer Array
    */

    echo '<pre>';

    var_dump($pdo->SelectUser('0'));

    echo '</pre>';
