<?php
namespace App\Models;

use App\Models\Model;

class User extends Model {
        public static $fields = [
            'email',
            'password',
            'username',
            'user_role',
            'last_name',
            'first_name',
            'created_at',
            'updated_at',
            'deleted_at'
        ];

        public static $table = 'users';

        public function __construct()
        {
            # code ...
        }

        // Get the last inserted data
        private static function getLastInserted($conn)
        {
            $query = "SELECT * FROM ".self::$table." ORDER BY id DESC LIMIT 1;";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        # select queries end

        # start add new data methods
        // Create using the save method
        // public function save()
        // {
        //     $user_data = [
        //     'first_name' => $this->first_name,
        //     'last_name' =>  $this->last_name,
        //     'username' =>   $this->username,
        //     'email' =>      $this->email,
        //     'password' =>   $this->password,
        //     'application_info_id' => $this->application_info_id,
        //     'user_role' =>  $this->user_role,
        //     'created_at' => date("Y-m-d H:i:s"),
        //     'updated_at' => date("Y-m-d H:i:s"),
        //  ];
        //     $query = "INSERT INTO ". $this->table . " (first_name, last_name, username, email, password,
        //           application_info_id, user_role, created_at, updated_at) 
        //           VALUES(:first_name, :last_name, :username, :email, :password,
        //           :application_info_id, :user_role, :created_at, :updated_at);";
        //     try {
        //         $stmt = $this->conn->prepare($query);
        //         $stmt->execute(self::santizedData($user_data));
        //         $responseWrapper['message'] = 'Executed';
        //         $responseWrapper['error'] = false;
        //         $responseWrapper['last_inserted'] = self::getLastInserted($conn);
        //     } catch (PDOException $e) {
        //         $responseWrapper['message'] = $e->getMessage();
        //         $responseWrapper['error'] = true;
        //         $responseWrapper['last_inserted'] = null;
        //     }

        //     return $responseWrapper;
        // }

        // Create using the static method
        // public static function create($conn, $data)
        // {
        //     $data['created_at'] = date("Y-m-d H:i:s");
        //     $data['updated_at'] = date("Y-m-d H:i:s");

        //     $query = "INSERT INTO users (first_name, last_name, username, email, password,
        //           application_info_id, user_role, created_at, updated_at) 
        //           VALUES(:first_name, :last_name, :username, :email, :password,
        //           :application_info_id, :user_role, :created_at, :updated_at);";
      
        //     $stmt = $conn->prepare($query);

        //     $responseWrapper = [];

        //     $data = self::formatUserData($data);
        //     try {
        //         $stmt->execute(self::santizedData($data));
        //         $responseWrapper['message'] = 'Executed';
        //         $responseWrapper['error'] = false;
        //         $responseWrapper['last_inserted'] = self::getLastInserted($conn);
        //     } catch (PDOException $e) {
        //         $responseWrapper['message'] = $e->getMessage();
        //         $responseWrapper['error'] = true;
        //         $responseWrapper['last_inserted'] = null;
        //     }

        //     return $responseWrapper;
        // }
        #end add new data methods


        # delete queries start
        public static function delete($conn, $id)
        {
            $query = "DELETE FROM users WHERE id = ?";
            $stmt = $conn->prepare($query);
            try {
                $stmt->execute([$id]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        # deletet queries end


        # helper fucntion start
        // Format data
        private static function formatUserData($data)
        {
            return [
                  'first_name' => $data['first_name'],
                  'last_name' =>  $data['last_name'],
                  'username' =>   $data['username'],
                  'email' =>      $data['email'],
                  'password' =>   $data['password'],
                  'application_info_id' => $data['application_info_id'],
                  'user_role' =>  $data['user_role'],
                  'created_at' => date("Y-m-d H:i:s"),
                  'updated_at' => date("Y-m-d H:i:s")
               ];
        }

        // Snitize data
        private static function santizedData($data)
        {
            foreach ($data as $key => $value) {
                $data[$key] = htmlspecialchars(strip_tags($value));
            }
            return $data;
        }

        #helper function end
    }
