<?php
namespace App\Interfaces;

interface Crud {
    /**
     * Create
     * 
     * @param Array $data
     */
    public static function create($data);

    /**
     * Update
     */
    public function update($data);

    /**
     * Select
     * 
     * @param Array $fields
     */
    public static function select($fields = []);

    /**
     * All
     */
    public static function all();

    /**
     * Find By id
     * 
     * @param $id
     */
    public static function find($id);

    /**
     * Destroy
     */
    public function destroy();
}