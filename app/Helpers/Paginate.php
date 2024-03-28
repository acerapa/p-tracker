<?php
namespace App\Helpers;

class Paginate {
    /**
     * @var Array $items Items from the model
     */
    public $items;

    /**
     * @var Int $paginate_by Paginate by
     */
    public $paginate_by;

    /**
     * @var Int $total_items Total items stored in database
     */
    public $total_items;

    /**
     * @var Int $current_page current page
     */
    public $current_page = 1;
    
    /**
     * @var Int $page_count Total pages based on the total_items and paginate_by
     */
    public $page_count = 0;

    /**
     * Constructor
     */
    public function __construct($items, $paginate_by, $total_items)
    {
        $this->items       = $items;
        $this->paginate_by = $paginate_by;
        $this->total_items = $total_items;
        $this->page_count  = ceil($total_items / $paginate_by);

        // set current page
        $this->current_page = self::getCurrentPage();
    }

    /**
     * Get current page in the pagination
     * 
     * @return Int
     */
    private static function getCurrentPage()
    {
        return isset(Request::getData()['page']) ? Request::getData()['page'] : 1;
    }
}