<?php

declare(strict_types=1);

class DataSource {

    private string $servername;
    private string $username;
    private string $password;
    private string $database;


    public function __construct() {
        $this->servername = "Becode.local";
        $this->username = "Becode";
        $this->password = "Becode";
        $this->database = "classicmodels";
    }

    public function getCustomers(): array {
        $sql = "SELECT * FROM customer";
        return $this->getRows($sql);
    }

    public function getProducts(): array {
        $sql = "SELECT * FROM product";
        return $this->getRows($sql);
    }

    // public function getCustomerGroups() {
    //     $sql = "SELECT * FROM customer_group";
    //     return $this->runScript($sql);
    // }

    public function getCustomerGroupById(int $id) {
        $sql = "SELECT * FROM customer_group WHERE id = {$id}";
        return $this->getRows($sql)[0];
    }

    private function runScript(string $sql) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $result = $conn->query($sql);

        // close connection
        $conn->close();

        return $result;
    }

    private function getRows(string $sql): array {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        $rows = [];
        while ($row = $result->fetch_array()) {
            array_push($rows, $row);
        }

        // free result set
        $result->close();

        // close connection
        $conn->close();

        return $rows;
    }
}
