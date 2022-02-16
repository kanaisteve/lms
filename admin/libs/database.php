<?php 
    class Database {
        protected $localhost = "localhost";
        protected $servername = "u863218974_kanai";
        protected $password = "Muchona37#";
        protected $database = "u863218974_kanaitech";
        public $mysqli;
        
        public function connect() {
            // create connection
            $this->mysqli = new mysqli($this->localhost, $this->servername, $this->password, $this->database);
            // check connection
            if ($this->mysqli->connect_error) {
                die("Connection failed: " . $this->mysqli->connect_error);
            }
            return $this->mysqli;
        }
    }
?>