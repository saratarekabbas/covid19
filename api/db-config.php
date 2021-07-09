<?php

class db
{
    public function connect()
    {
        $host = "127.0.0.1"; //localhost
        $user = "root";
        $password = "";
        $dbname = "covid19";

        // Connect to the db
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}
