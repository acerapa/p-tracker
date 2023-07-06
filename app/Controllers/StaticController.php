<?php 
namespace App\Controllers;

use Exception;
use App\Controllers\Controller;

class StaticController extends Controller {
    function __construct() {
        parent::__construct();
    }

    /**
     * Return the file
     * 
     * @return File
     */
    // create a function the returns the file regards of its type
    public function getFile($directory, $file) {
        $path = public_path();
        $directory = decrypt($directory);

        $file = "$path"."$directory"."$file";
        
        if (!file_exists($file)) {
            throw new Exception("File not found");
            return;
        }

        $file_type = mime_content_type($file);
        $file_size = filesize($file);
        $file_ext  = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        switch ($file_ext) {
            case 'css':
                header("Content-Type: text/css");
                break;
            case 'js':
                header("Content-Type: text/javascript");
                break;
            default:
                header("Content-Type: $file_type");
                break;
        }

        header("Content-Length: $file_size");

        readfile($file);
    }
}