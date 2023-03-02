<?php
namespace App\Models;

use App\Traits\Crud;
use App\Abstracts\ModelAbstract;
use Doctrine\Inflector\InflectorFactory;

class Model extends ModelAbstract {
    use Crud;

    /**
     * Constructor
     */
    public function __construct()
    {
        # code ...
    }

    public static function getTableNameFromClassName()
    {
        $inflector = InflectorFactory::create()->build();
        $namespace = $inflector->pluralize(strtolower(get_called_class())); 

        return end(explode('\\', $namespace));
    }
}
