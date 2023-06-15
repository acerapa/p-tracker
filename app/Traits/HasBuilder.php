<?php
namespace App\Traits;

use App\Helpers\Sanitizer;

trait HasBuilder {
    /**
     * static function calls
     */
    public static function __callStatic($method, $args)
    {
        global $table;
        global $class;

        $m = strtolower($method);
        $table = self::getTableNameFromClassName();
        
        $namespaced_model = get_called_class();
        $class = new $namespaced_model();

        $builder = null;

        switch ($m) {
            case 'where':
                $builder = (new self())->where($args);
                break;
            case 'get':
                $builder = (new self())->get($args);
                break;
        }

        return $builder;
    }

    /**
     * non static function calls
     */
    public function __call($method, $args)
    {
        global $table;

        $m = strtolower($method);
        $table = self::getTableNameFromClassName();

        $builder = null;

        switch ($m) {
            case 'where':
                $builder = $this->where($args);
                break;
            case 'get':
                $builder = $this->get($args);
                break;
        }

        return $builder;
    }

    /**
     * Where sql function
     */
    private function where($args)
    {
        global $table;

        $query = $this->query . $table;
        $this->query = $query;

        return $this;
    }

    /**
     * Get sql function
     */
    private function get()
    {
        global $table;
        global $class;

        if (!strstr($this->query, $table)) {
            $this->query = $this->query . $table;
        }

        $stmt    = self::getConnection()->query($this->query);
        $results = $stmt->fetchAll();

        $data = [];
        foreach ($results as $dt) {
            // revert charactes
            $dt = Sanitizer::revertChars($dt);
            // create model called instance
            $class->setAttributes($dt);
            array_push($data, $class);
        }

        return $data;
    }
}
