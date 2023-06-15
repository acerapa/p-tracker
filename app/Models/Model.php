<?php
namespace App\Models;

use App\Traits\HasCrud;
use App\Traits\HasBuilder;
use App\Config\Database;
use App\Interfaces\Crud;
use App\Abstracts\ModelAbstract;
use Doctrine\Inflector\InflectorFactory;

class Model extends ModelAbstract implements Crud {
    use HasCrud, HasBuilder;

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
     * Set property
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }
}
