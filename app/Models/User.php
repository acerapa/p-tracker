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

    /**==============================
     * METHOD
     ================================*/
    public function getFullName()
    {
        return $this->first_name ." ". $this->last_name;
    }

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

}
