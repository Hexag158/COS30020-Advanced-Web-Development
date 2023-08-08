<?php

class HitCounter {
    private $conn;
    private $tablename;
    
    // Constructor to initialize the database connection
    public function __construct($host, $username, $password, $dbname, $tablename) {
        $this->tablename = $tablename;
        $this->conn = new mysqli($host, $username, $password, $dbname);
        
        // Check if the connection was successful
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    // Get and display the number of hits
    public function getHits() {
        $sql = "SELECT hits FROM $this->tablename";
        $result = $this->conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hits = $row['hits'];
            echo "Hits: $hits <br />";
        } else {
            echo "Hits: 0";
        }
    }
    
    // Add one to hits and update the table
    public function setHits() {
        $sql = "UPDATE $this->tablename SET hits = hits + 1";
        $this->conn->query($sql);
    }
    
    // Close the database connection
    public function closeConnection() {
        $this->conn->close();
    }
    
    // Reset hits to zero
    public function startOver() {
        $sql = "UPDATE $this->tablename SET hits = 0";
        $this->conn->query($sql);
    }
}
