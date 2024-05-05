<?php
namespace App\Models;

use App\Models\Model;

class ExpenseType extends Model {
    /**==============================
     * PROPERTIES
     ================================*/

    public static $fields = [
        'name',
        'created_at'
    ];

    public static $table = 'expense_types';
    /**==============================
     * METHODS
     ================================*/
}