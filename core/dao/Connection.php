<?php

class Connection extends PDO
{
    const HOSTNAME = "localhost";
    const USERNAME = "root";
    const PASSWORD = "";
    const DBNAME = "jobsmart";

    private $conn;

    public function __construct()
    {
        $this->conn = parent::__construct(
            "mysql:dbname=" . Connection::DBNAME . ";host=" . Connection::HOSTNAME,
            Connection::USERNAME,
            Connection::PASSWORD
        );

    }

    private function setParams($statement, $parameters = array())
    {
        foreach ($parameters as $key => $value) {

            $this->bindParam($statement, $key, $value);
        }
    }

    private function bindParam($statement, $key, $value)
    {
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array())
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
    }

    public function select($rawQuery, $params = array()): array
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}