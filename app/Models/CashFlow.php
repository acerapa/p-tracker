<?php
namespace App\Models;

use App\Models\Model;
use App\Models\ExpenseType;

class CashFlow extends Model {
    public static $fields = [
        'when',
        'amount',
        'user_id',
        'is_income',
        'description',
        'expense_type'
    ];

    public static $table = "cashflows";

    public function getExpenseName() {
        if (isset($this->expense_type)) {
            $expense_type = ExpenseType::find($this->expense_type);
            return $expense_type->name;
        }

        return '';
    }
}