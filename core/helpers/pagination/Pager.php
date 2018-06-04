<?php

namespace App\Core\Helper;

/**
 * Pager Model class
 */
class Pager {

    protected $page;
    protected $items;
    protected $per_page;

    /**
     * Constructor
     *
     * @param $page
     * @param $items
     * @param int $per_page
     */
    public function __construct($page, $items, $per_page = 30)
    {
        $this->page = $page;
        $this->items = $items;
        $this->per_page = $per_page;
    }

    /**
     * Has next page
     *
     * @return boolean
     */
    public function hasNext()
    {
        return $this->next() == $this->page() ? false : true;
    }

    /**
     * Has previous page
     *
     * @return boolean
     */
    public function hasPrevious()
    {
        return $this->page() == 1 ? false : true;
    }

    /**
     * Get previous page
     */
    public function previous()
    {
        return $this->page() == 1 ? 1 : $this->page() - 1;
    }

    /**
     * Get next page
     */
    public function next()
    {
        return $this->page() == $this->pages() ? $this->page() : $this->page() + 1;
    }

    /**
     * Get number of pages
     */
    public function pages()
    {
        return ceil($this->items / $this->per_page);
    }

    /**
     * Get current page
     *
     * @return int
     */
    public function page()
    {
        return $this->page > $this->pages() ? 1 : $this->page;
    }

}