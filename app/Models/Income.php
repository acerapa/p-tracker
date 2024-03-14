<?php
namespace App\Models;

use App\Models\Model;

class Income extends Model {
    public static $fields = [
        'when',
        'amount',
        'user_id',
        'description',
    ];

    public static $table = "incomes";
}