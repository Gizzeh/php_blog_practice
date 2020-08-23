<?php

require_once '../Config/config.php';

class DataBase {

    private $pdo;

    public function __construct( array $config )
    {
        $this->connect( $config );
    }

    private function connect( array $config )
    {
        $dsn = 'mysql:host='.$config['server'].';dbname='.$config['name'];

        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password']);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'Подключение не удалось: '.$e->getMessage();
        }

        return $this;
    }

    public function execute(string $sql, array $params = [])
    {
        $statement = $this->pdo->prepare($sql);

        return $statement->execute($params);
    }

    public function query(string $sql, array $params = [])
    {
        $statement = $this->pdo->prepare($sql);

        $statement->execute($params);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) return [];

        return $result;
    }

}








