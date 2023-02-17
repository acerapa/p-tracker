<?php
    class Response {
        function __construct()
        {
            # code ...
        }

        public static function response($data = [], $status = 200, $error = false, $message = 'success')
        {
            return [
                'data' => $data,
                'status' => $status,
                'is_error' => $error,
                'message' => $message
            ];
        }
    }

?>
