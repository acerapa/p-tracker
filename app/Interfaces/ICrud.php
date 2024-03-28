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
     * Paginate
     * 
     * @param Int $paginate_by
     */
    public static function paginate($paginate_by);

    /**
     * Take
     * 
     * @param Int $take
     */
    public static function take($take);

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