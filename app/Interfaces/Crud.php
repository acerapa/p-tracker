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
    public function update();

    /**
     * Select
     */
    public static function select();

    /**
     * Destroy
     */
    public function destroy();
}