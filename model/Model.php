<?php
require('traits/Crud.php');
// require('abstracts/ModelAbstract.php');
use App\Abstracs\ModelAbstract;

use plejus\PhpPluralize\Inflector;

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
        return (new Inflector())->plural(strtolower(get_called_class()));
    }
}
