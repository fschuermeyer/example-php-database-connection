<?php

    function pdoObject(array $database):PDO
    {
        /**
         *  Try -> Wird Versucht auszuführen, wenn es Fehlschlägt wird 
         *  ausgführt was zwischen den Geschweiften Klammern nach Catch steht.
         * 
         *  Das ist zum Beispiel der Fall wenn die Datenbank Verbindung nicht Hergestellt werden kann.
         */

        try{
            /* PDO Objekt um Datenbank Verbindung Herzustellen */

            $pdo = new PDO('mysql:host='.$database['host'].';dbname='.$database['name'],
                            $database['user'],
                            $database['pass'],
                            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
                        );

            /* UTF 8 Typ festlegen um Fehler zu Vermeiden */
            $pdo->exec("SET CHARACTER SET utf8"); 


            return $pdo;
        }  
        catch(PDOException $err) {
            echo "ERROR: Unable to connect: " . $err->getMessage();
            return false;
        }

    }

    function SelectUser(PDO $pdo,int $id)
    {
        /**
         *  Prepared Statment um SQL Exception zu Verhindern, 
         *  zusätzlich kann noch ein Vorheriges Escaping Stattfinden.
         * 
         *  Das Escaping passiert in der e() Function
         * */

        $statement = $pdo->prepare("SELECT * FROM userlist WHERE PersonID = :id");
        $result = $statement->execute(['id' => e($id)]);

        if($result){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $result = 'Not Found';
        }

        
        return $result;
    }

    function e($value):string
    {
        /**
         *  Escaping der Variable 
         *  Escaping bedeuet das Sonderzeichen durch das HTML Äquivalent
         *  ersetz werden um Injections jeglicher Form zu verhindern
         */
        return htmlspecialchars($value,ENT_QUOTES);
    }