<?php
    class Database {

        private $server_name   =  "localhost"; //for now since it is in local
        private $username      =  "root";      //for now since it is in local
        private $password      =  "";          //for now since it is in local
        private $dbname        =  "p_tracker_db";
        private $conn_name     = "mysql"; 
        private $connection;
        private $conn_stt      =  [];

        /**
         *  Initialize new connection to the database
         */
        function __construct() {
            try {
                $connection_string = $this->conn_name.":host=".$this->server_name.";dbname=".$this->dbname;
                $this->connection = new PDO($connection_string, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn_stt['success'] = true;
                $this->conn_stt['message'] = "Connected";
            } catch (PDOException $e) {
                $this->conn_stt['success'] = false;
                $this->conn_stt['message'] = $e->getMessage();
            }
        } 

        /**
         * Get the connection after initialization
         * 
         * @return $connection
         */
        public function getConnection()
        {
            return $this->connection;
        }
        /**
         * Get the connection status
         * 
         * @return bool
         */
        public function getConnectionStatus()
        {
            return $this->conn_stt;
        }
    }

?>