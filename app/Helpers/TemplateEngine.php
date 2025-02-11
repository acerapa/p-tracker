<?php
namespace App\Helpers;

class TemplateEngine {
    /**
     * @var String $views Path to the Views
     */
    private $views_path;

    function __construct($path, $content)
    {
        $this->views_path = $path;
    }

    function useLayout($layout)
    {
        // code ...
    }

    function section($name) {
        // code ...
    }

    function useSection($section_name) {
        // code ...
    }
}
