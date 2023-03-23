<?php
namespace App\Config;

use PDO;
use PDOException;
class Database {

    private $server_name;
    private $username;
    private $password;
    private $dbname;
    private $conn_name;
    private $connection;
    private $conn_stt = [];

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
        } catch (PDOException $e) {
            // redirect to sql error with message
            $route = '/error/sql?msg='.$e->getMessage();
            echo "<script>window.location.href='$route'</script>";
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