<?php
namespace App\Models;

use App\Models\Model;

class CashFlow extends Model {
    public static $fields = [
        'when',
        'amount',
        'user_id',
        'is_income',
        'description',
    ];

    public static $table = "cashflows";
}