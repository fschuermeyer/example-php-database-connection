<?php

class ConnectionPDO
{

    private $pdo;

    public function __construct(array $database)
    {
        /**
         *  Try -> Wird Versucht auszuführen, wenn es Fehlschlägt wird
         *  ausgführt was zwischen den Geschweiften Klammern nach Catch steht.
         *
         *  Das ist zum Beispiel der Fall wenn die Datenbank Verbindung nicht Hergestellt werden kann.
         *
         *  Die Hergestellte Verbindung wird in der Instanz Variable $pdo
         *  gespeichert so, das diese in der Gesammten Klasse Verfügbar ist.
         */

        try {
            /* PDO Objekt um Datenbank Verbindung Herzustellen */

            $pdo = new PDO('mysql:host=' . $database['host'] . ';dbname=' . $database['name'],
                $database['user'],
                $database['pass'],
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );

            /* UTF 8 Typ festlegen um Fehler zu Vermeiden */
            $pdo->exec("SET CHARACTER SET utf8");

            $this->pdo = $pdo;
        } catch (PDOException $err) {
            echo "ERROR: Unable to connect: " . $err->getMessage();
            return false;
        }

    }

    public function SelectUser(int $id): array
    {
        /**
         *  Prepared Statment um SQL Injections zu Verhindern,
         *  zusätzlich kann noch ein Vorheriges Escaping Stattfinden.
         *
         *  Das Escaping passiert in der e() Function
         *
         *  Diese Function ist Public heißt das Sie von Außerhalb aufgerufen werden kann.
         * */

        $statement = $this->pdo->prepare("SELECT * FROM userlist WHERE PersonID = :id");
        $result = $statement->execute(['id' => $this->e($id)]);

        $return = $this->fetch($statement, $result);

        return $return;
    }

    private function e($value): string
    {
        /**
         *  Escaping der Variable
         *  Escaping bedeuet das Sonderzeichen durch das HTML Äquivalent
         *  ersetz werden um Injections jeglicher Form zu verhindern
         *
         *  Diese Funktion ist Privat heißt sie kann
         *  nicht außerhalb einer Klassen Instanz aufgerufen werden.
         */
        return htmlspecialchars($value, ENT_QUOTES);
    }

    private function fetch($statement, bool $result): array
    {

        /**
         *  Es wird geprüft ob der Execute Erfolgreich war wenn ja,
         *  wird der Fetch All ausgeführt, wenn nicht wird
         *  eine Not Found Zurück gegeben.
         *
         */

        if ($result) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = ['Not Found'];
        }

        return $result;
    }

}
