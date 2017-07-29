<?php
    class Database {
      private $host = 'localhost';
      private $username = 'root';
      private $password = '';
      private $dbname='api_db';

      public $conn;

      // Get the database connection
      public function getConnection() {
        $this->conn = null;

        try {
          $this->$conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $username, $password);

          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
          echo 'Connection error: '. $e->getMessage();
        }

        return $this->conn;
      }
    }
?>