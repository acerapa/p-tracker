<?php
namespace App\Config;

use PDO;
class Database {

    private $server_name;
    private $username;
    private $password;
    private $dbname;
    private $conn_name;
    private $connection;
    private $conn_stt = [];

    public static $conn;
    public static $test = "";

    /**
     *  Initialize new connection to the database
     */
    function __construct() {
        // initialized
        $this->server_name   =  $_ENV["DB_HOST"];
        $this->username      =  $_ENV['DB_USERNAME'];
        $this->password      =  $_ENV['DB_PASSWORD'];
        $this->dbname        =  $_ENV['DB_DATABASE'];
        $this->conn_name     =  $_ENV['DB_CONNECTION'];

        try {
            $connection_string = $this->conn_name.":host=".$this->server_name.";dbname=".$this->dbname;
            $this->connection = new PDO($connection_string, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn_stt['success'] = true;
            $this->conn_stt['message'] = "Connected";
            
            self::$conn = $this->connection;
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
     * @return Array
     */
    public function getConnectionResponse()
    {
        return $this->conn_stt;
    }

    /**
     * Check connection status
     * 
     * @return boolean
     */
    public function isConnected()
    {
        return $this->conn_stt['success'];
    }
}

?>