<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "school_bussiness_tour_management";

    public $link;
    public $error;

    public function __construct()
    {
        $this->connectDB(); 
    }
    private function connectDB()
    {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->link->connect_error) {
            throw new Exception("Connect fail: " . $this->link->connect_error);
        }
    }

    // Select or Read data
    public function select($query)
    {
        $result = $this->link->query($query);
        if ($result === false) {
            throw new Exception("Query error: " . $this->link->error);
        }
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    // Insert data
    public function insert($query)
    {
        $insert_row = $this->link->query($query);
        if ($insert_row === false) {
            throw new Exception("Query error: " . $this->link->error);
        }
        return $insert_row;
    }

    // update data
    public function update($query)
    {
        $update_row = $this->link->query($query);
        if ($update_row === false) {
            throw new Exception("Query error: " . $this->link->error);
        }
        return $update_row;
    }

    // delete data
    public function delete($query)
    {
        $delete_row = $this->link->query($query);
        if ($delete_row === false) {
            throw new Exception("Query error: " . $this->link->error);
        }
        return $delete_row;
    }
}