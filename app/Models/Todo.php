<?php
namespace App\Models;

use App\Models\Model;


class Todo extends Model {
    /**==============================
     * PROPERTIES
     ================================*/
    const PENDING   = 'pending';
    const DONE      = 'done';

    public static $fields = [
        'user_id',
        'title',
        'description',
        'date_to_fullfill',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $table = 'todos';

    /**==============================
     * METHOD
     ================================*/
}