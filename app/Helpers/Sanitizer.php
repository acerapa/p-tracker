<?php
namespace App\Helpers;

class Sanitizer {
    public static function sanitize(array $data) : array {
        // sanitize
        foreach ($data as $key => $value) {
            $data[$key] = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data[$key] = htmlspecialchars($data[$key], ENT_QUOTES, 'UTF-8');
        }

        return $data;
    }

    public static function revertChars(array $data) {
        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars_decode($value);
        }

        return $data;
    }
}