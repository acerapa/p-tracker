<?php
namespace App\Interfaces;

interface ICrud {
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