<?php
namespace App\Models;

use App\Traits\Crud;
use App\Config\Database;
use App\Interfaces\Crud as CrudInterface;
use App\Abstracts\ModelAbstract;
use Doctrine\Inflector\InflectorFactory;

class Model extends ModelAbstract implements CrudInterface {
    use Crud;

    /**
     * Constructor
     */
    public function __construct()
    {
        # code ...
    }

    public static function getConnection()
    {
        $db = new Database();
        return $db->getConnection();
    }

    /**
     * Get table name by basing in the model class name
     * 
     * @return String
     */
    public static function getTableNameFromClassName()
    {
        $inflector = InflectorFactory::create()->build();
        $namespace = $inflector->pluralize(strtolower(get_called_class())); 
        $className = explode('\\', $namespace);

        return end($className);
    }

    /**
     * Sanitize data from html special characters
     * 
     * @param Array $data
     * 
     * @return Array
     */
    private static function santizedData($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars(strip_tags($value));
        }
        return $data;
    }

    /**
     * Set property
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }
}
